from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split, cross_validate
from sklearn.linear_model import SGDClassifier
from sklearn.preprocessing import StandardScaler
from sklearn.metrics import accuracy_score
import numpy as np


class Train:
    def __init__(self, features, target):

        self.features = features
        self.target = target
        self.x_train, self.x_test, self.y_train, self.y_test = \
            train_test_split(features, target, train_size=.6, test_size=.4)
        self.x_test, self.x_val, self.y_test, self.y_val = \
            train_test_split(self.x_test, self.y_test, train_size=.5, test_size=.5)
        self._score_rf = []
        self._pred = []

    def train_rf(self, est: (list, tuple) = (400, 500, 100), cv: int = 5) -> None:
        """A random forest classifier with same parameters.

        Args:
            est: start, stop, step for substitution at n_estimators in RandomForestClassifier
            cv: Determines the cross-validation splitting strategy.
        """
        for _est in range(*est):
            cv_results = cross_validate(RandomForestClassifier(n_estimators=_est), self.features, self.target, cv=cv,
                                        scoring=(["accuracy", "average_precision"]), return_train_score=True)
            self._score_rf.append([cv_results.get("test_accuracy"), cv_results.get("test_average_precision")])

    def train_sgdc(self,
                   eta: (list, tuple) = (0.1, 1.5, 20),
                   alpha: (int, float) = .5,
                   epsilon: (int, float) = .9,
                   learning_rate: str = "invscaling",
                   normalize: bool = False,) -> None:
        """Linear classifiers with SGD training.

        Args:
            normalize: If true fit to data, then transform it.
            eta: The initial learning rate.
            alpha: Constant that multiplies the regularization term.
            epsilon: Epsilon in the epsilon-insensitive loss functions.
            learning_rate: The learning rate.
        """
        if normalize:
            x_train = StandardScaler().fit_transform(self.x_train, self.y_train)
            x_val = StandardScaler().fit_transform(self.x_val, self.y_val)
            x_test = StandardScaler().fit_transform(self.x_test, self.y_test)
        else:
            x_train, x_val, x_test = self.x_train, self.x_val, self.x_test
        mt0 = 0
        result_clf: SGDClassifier = SGDClassifier()
        for eta0 in np.linspace(eta[0], eta[1], eta[2]):
            clf = SGDClassifier(alpha=alpha,
                                learning_rate=learning_rate,
                                eta0=eta0, epsilon=epsilon).fit(x_train, self.y_train)
            prdct = clf.predict(x_val)
            mt = accuracy_score(self.y_val, prdct)
            if mt > mt0:
                mt0 = mt
                result_clf = clf
        self._pred.append([normalize, accuracy_score(self.y_test, result_clf.predict(x_test))])

    def __str__(self):
        out = ""
        if self._pred:
            out += "\nLinear classifiers:\n"
            for i in self._pred:
                out += f"\n{'With normalization' if i[0] else 'Without normalization'} {i[1]}\n"
        if self._score_rf:
            out += "Random Forest:\n"
            for i in self._score_rf:
                out += f"\naccuracy:\t{i[0]}\naverage_precision:\t{i[1]}\n"
        return f"Result:\n\n{out}"
