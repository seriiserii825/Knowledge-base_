import json
# save data to json file
new_data = {
    'name': 'John',
    'email': 'some@mail.com'
}
try:
    with open('data.json', 'r') as file:
        #reading old data
        data = json.load(file)
        #updating old data with new data
        data.update(new_data)
except FileNotFoundError:
    with open('data.json', 'w') as file:
        #saving updated data
        json.dump(new_data, file, indent=4)
else:
    with open('data.json', 'w') as file:
        #saving updated data
        json.dump(data, file, indent=4)

