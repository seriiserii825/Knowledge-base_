with open(variables_file, 'r') as file:
    data = file.readlines()
for i in range(len(data)):
    if data[i] == '\n':
        data[i] = ''
with open(variables_file, 'w') as file:
    file.writelines(data)


