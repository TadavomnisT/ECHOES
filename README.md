# ECHOES

![ECHOES_logo](./docs/ECHOES_logo.png)

Edge and Cloud Hybrid Optimization Environment Simulator (ECHOES)

## What is ECHOES?

ECHOES stands for **Edge and Cloud Hybrid Optimization Environment Simulator**, which is a free and open-source tool to simulate an Edge/Cloud-Hybrid network topology, in order to optimise and test methods for offloading Tasks from user's device to edge-server or cloud-server.


## Installation

### 1-Install Requirements
* **PHP**,
* **python** and **PIP**,
* **[Mknapsack](https://github.com/jmyrberg/mknapsack)**, Install with `pip install mknapsack`
```shell
pip install mknapsack
```
### 2-Install ECHOES
```shell
git clone https://github.com/TadavomnisT/ECHOES.git
```

## Usage


**Shell #1 :** Start the server for knapsack python wrapper
```shell
cd ECHOES/src
python knapsack_server.py
```

**Shell #2 :** Run the simulator
```shell
cd ECHOES/Tests
php run_tests.php
```

## Note

* There requirement for python will not be needed in future versions as I am re-implementing Knapsack module with PHP.
* Furture documents and explanations will be added soon.

## Author 

* Behrad.B (TadavomnisT) (behroora@yahoo.com)

## Lisense

* GPLv3+
