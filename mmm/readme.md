Table of Contents
=================


* [Table of Contents](#table-of-contents)
* [1. Lab 1](#Lab-1)
  * [1.1 Example](#11-example)
  * [1.2 Best score](#12-best-score)


# 1. Lab 1
## [Example](lab1/example.py).

```python
from ssu.mmm.lab1.read_data import ReadData
from ssu.mmm.lab1.train import Train

r = ReadData(sample_size=5000, cache=True)
t = Train(r.features, r.target)
t.train_sgdc(eta=(0.1, 1.5, 20), alpha=.5, epsilon=.9, learning_rate=f"invscaling")
t.train_sgdc(eta=(0.1, 1.5, 20), alpha=.5, epsilon=.9, learning_rate=f"invscaling", normalize=True)
t.train_rf(est=(400, 500, 100), cv=5)
print(t)

```


## Best score:
```commandline
Result:


Linear classifiers:

Without normalization 0.536

With normalization 0.557

Result:


Linear classifiers:

Without normalization 0.562

With normalization 0.518

Result:

Random Forest:

accuracy:	[0.643 0.624 0.626 0.626 0.673]
average_precision:	[0.69069386 0.67575374 0.68740945 0.66395208 0.70932018]
```
