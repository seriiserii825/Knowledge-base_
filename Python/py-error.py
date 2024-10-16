#File not found
with open('file-not-found.txt') as f:
    print(f.read())

#KeyError
d = {'name': 'John'}
print(d['age'])

#IndexError
l = [1, 2, 3]
print(l[3])

#TypeError
print('2' + 2)


try:
    file = open("a_file.txt")
    a_dictionary = {"key": "value"}
    print(a_dictionary["om"])
except FileNotFoundError:
    file = open("a_file.txt", "w")
    file.write("Something")
except KeyError as error_message:
    print(f"The key {error_message} does not exist.")
else:
    content = file.read()
    print(content)
finally:
    # file.close()
    # print("File was closed.")
    raise TypeError("This is an error that I made up.")
