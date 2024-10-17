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


# =============================
import pandas

data = pandas.read_csv("nato.csv")
nato_dict = {row.letter:row.code for (_, row) in data.iterrows()}
print(f"nato_dict: {nato_dict}")

def generate_phonetic():
    user_input = input("Enter a word: ").upper()
    if user_input != '':
        try:
            words = [nato_dict[item] for item in user_input]
        except KeyError as error_message:
            print("Please enter only letters")
            generate_phonetic()
        else:
            print(f"words: {words}")

generate_phonetic()

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


