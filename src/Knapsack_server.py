from flask import Flask, request, jsonify
from mknapsack import solve_multiple_knapsack
import json

app = Flask(__name__)

@app.route('/solve_knapsack', methods=['POST'])
def solve_knapsack():
    data = request.json
    item_values = data['item_values']
    item_weights = data['item_weights']
    knapsacks = data['knapsacks']
    res = solve_multiple_knapsack(item_values, item_weights, knapsacks, method_kwargs={"check_inputs": 0})
    return jsonify(res.tolist())

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)