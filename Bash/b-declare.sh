declare -u upper_var="hello world"
echo "$upper_var"  # Outputs "HELLO WORLD"

declare -l lower_var="HELLO WORLD"
echo "$lower_var"  # Outputs "hello world"

# print all variables
declare -p 

# This variable is read-only
declare -r readonly_var="Fixed Value" 
readonly_var="New Value"  # Это вызовет ошибку

# Declare an integer variable
declare -i num=10 
num+=5
echo "$num"  # Вывод: 15

num="hello"
echo "$num"  # It will display 0.

# Declare an indexed array
declare -a my_array=("apple" "banana" "cherry")
# Access and print elements
echo "${my_array[@]}"  # Outputs: apple banana cherry

