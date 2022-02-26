from ssu.mmm.lab1.read_data import ReadData
from ssu.mmm.lab1.train import Train

r = ReadData(sample_size=5000)
t = Train(r.features, r.target)
t.train_sgdc(eta=(0.1, 1.5, 20), alpha=.5, epsilon=.9, learning_rate=f"invscaling")
t.train_sgdc(eta=(0.1, 1.5, 20), alpha=.5, epsilon=.9, learning_rate=f"invscaling", normalize=True)
t.train_rf(est=(400, 500, 100), cv=5)
print(t)
