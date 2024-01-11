import json
import sys

from mknapsack import solve_multiple_knapsack

data = json.loads(sys.argv[1])

res = solve_multiple_knapsack(
                data[0],
                data[1],
                data[2],
                method_kwargs={"check_inputs": 0}
            )

print(json.dumps(res.tolist()))