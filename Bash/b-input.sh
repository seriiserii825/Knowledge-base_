### input(STDIN)
```
$0 - filename
echo $0 $1 $2
args=("$@") -- all arguments from terminal
echo ${args[0]} ${args[1]} ${args[2]}
echo $@
echo $# - number of arguments
for arg in "$@"; do
    echo $arg
done
```
### create dir in Downloads
```
if [ "$#" -ne 2 ]; then
    echo "Usage: $0 <user> <directory>"
    exit 1
fi
echo "Executing script: $0"
echo "User: $1"
echo "Directory: $2"
download_dir="/home/$1/Downloads"
mkdir -p "$download_dir/$2"
```
### print on the new line
```
echo "Print your name"
read name
echo "Your name is $name"
```
### print on the same line
```
read -p "Username: " user_var
echo "Username: $user_var"
echo -e "Enter file name: \c"
read file_name
```
### hide password
```
read -sp "Password: " pass_var
echo ""
echo "Username: $user_var"
echo "password: $pass_var"
```
### enter array of args
```
echo "Enter names: "
read -a names
echo "Names: ${names[0]}, ${names[1]}"
```
