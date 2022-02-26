import pandas as pd
import pathlib
import hashlib
import numpy as np
import random
from PIL import Image
from tqdm import tqdm_notebook
import pickle


class ReadData:
    def __init__(self, student_id: str = "gregory_kitaev_411",
                 train_directory=pathlib.Path(str(
                     pathlib.Path(__file__).parent.resolve()).replace("lab1", f"data\\train")),
                 sample_size=5000, cache=False):
        self.student_id = student_id
        self.train_directory = train_directory
        self.sample_size = sample_size
        self._features = None
        self._target = None
        self._len: int = 0
        self._cache = cache
        self.read_data()

    def initialize_random_seed(self):
        """Инициализирует ГПСЧ из STUDENT_ID"""
        sha256 = hashlib.sha256()
        sha256.update(self.student_id.encode("utf-8"))

        fingerprint = int(sha256.hexdigest(), 16) % (2 ** 32)

        random.seed(fingerprint)
        np.random.seed(fingerprint)

    def read_target_variable(self):
        """Прочитаем разметку фотографий из названий файлов"""
        target_variable = {
            "filename": [],
            "is_cat": []
        }
        image_paths = list(self.train_directory.glob("*.jpg"))
        random.shuffle(image_paths)
        for image_path in image_paths[:self.sample_size]:
            filename = image_path.name
            class_name = filename.split(".")[0]
            target_variable["filename"].append(filename)
            target_variable["is_cat"].append(class_name == "cat")
        return pd.DataFrame(data=target_variable)

    def __read_data(self):
        image_size = (100, 100)
        features = []
        target = []
        data = self.read_target_variable()
        for i, image_name, is_cat in tqdm_notebook(data.itertuples(), total=len(data)):
            image_path = str(self.train_directory / image_name)
            image = Image.open(image_path)
            image = image.resize(image_size)  # уменьшаем изображения
            image = image.convert('LA')  # преобразуем в Ч\Б
            pixels = np.asarray(image)[:, :, 0]
            pixels = pixels.flatten()
            features.append(pixels)
            target.append(is_cat)
            self._len += 1
        return features, target

    def read_data(self):
        """Читает данные изображений и строит их признаковое описание"""
        path = self.train_directory.parent.joinpath("data.pickle")
        if self._cache and path.exists():
            size, self._features, self._target = self.__load_file(path)
            if size != self.sample_size:
                self._features, self._target = self.__read_data()
                with open(path, "wb") as f:
                    pickle.dump([self.sample_size, self._features, self._target], f)
                f.close()
        else:
            self._features, self._target = self.__read_data()
            if self._cache:
                with open(path, "wb") as f:
                    pickle.dump([self.sample_size, self._features, self._target], f)
                f.close()

    @property
    def features(self):
        return self._features

    @property
    def target(self):
        return self._target

    def __len__(self):
        return self._len

    def __load_file(self, path):
        """
        Args:
             path: The path to data file.
        """
        with open(path.resolve(), "rb") as file:
            return pickle.load(file)
