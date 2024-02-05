import matplotlib.pyplot as plt

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[1]) for line in lines]

with open('DecisionTree', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[1]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='DecisionTree Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Successful Terminated Tasks')
plt.title('Comparison MKP and DecisionTree on "Successful Terminated Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-DecisionTree-SuccessfulTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[1]) for line in lines]

with open('EdgeFirst', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[1]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='EdgeFirst Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Successful Terminated Tasks')
plt.title('Comparison MKP and EdgeFirst on "Successful Terminated Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-EdgeFirst-SuccessfulTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[1]) for line in lines]

with open('Random', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[1]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='Random Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Successful Terminated Tasks')
plt.title('Comparison MKP and Random on "Successful Terminated Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-Random-SuccessfulTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[1]) for line in lines]

with open('Default', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[1]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='Default Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Successful Terminated Tasks')
plt.title('Comparison MKP and Default on "Successful Terminated Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-Default-SuccessfulTasks.png')


# =================================================

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[2]) for line in lines]

with open('DecisionTree', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[2]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='DecisionTree Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Running Tasks')
plt.title('Comparison MKP and DecisionTree on "Running Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-DecisionTree-RunningTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[2]) for line in lines]

with open('EdgeFirst', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[2]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='EdgeFirst Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Running Tasks')
plt.title('Comparison MKP and EdgeFirst on "Running Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-EdgeFirst-RunningTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[2]) for line in lines]

with open('Random', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[2]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='Random Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Running Tasks')
plt.title('Comparison MKP and Random on "Running Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-Random-RunningTasks.png')

# ------------------------------------------------

plt.clf()

with open('Knapsack', 'r') as file:
    lines = file.readlines()

x = [int(line.split(',')[0]) for line in lines]
y = [int(line.split(',')[2]) for line in lines]

with open('Default', 'r') as file:
    other_lines = file.readlines()

other_x = [int(line.split(',')[0]) for line in other_lines]
other_y = [int(line.split(',')[2]) for line in other_lines]

plt.plot(x, y, linestyle='-', marker='d', color='black', label='MKP Line')
plt.plot(other_x, other_y, linestyle='-', marker='.', color='black', label='Default Line')

plt.xlabel('Seconds Passed')
plt.ylabel('Running Tasks')
plt.title('Comparison MKP and Default on "Running Tasks"')

axes = plt.gca()
axes.set_xlim([0,1000])

plt.legend()

plt.savefig('Knapsack-Default-RunningTasks.png')