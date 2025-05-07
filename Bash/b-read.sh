## read

```
-p prompt	Display a prompt before reading input (only in bash)
-s	Silent mode (no input echo, useful for passwords)
read -sp "Enter password: " password
echo

# multiple variables
read -p "Enter names separated by space: " name1 name2 name3
echo "Name 1: $name1"
echo "Name 2: $name2"
echo "Name 3: $name3"
# last variable stores the rest of the input

-n N	Read exactly N characters (without waiting for Enter)
read -n 1 -p "Press any key to continue..." key
echo

-t N	Timeout after N seconds
read -t 5 -p "You have 5 seconds to type something: " input
echo "Input: $input"

-r	Don’t treat backslashes as escape characters
read -r -p "Enter raw string: " raw
echo "You entered: $raw"

-a array	Store words into an array
read -a words -p "Enter some words: "
echo "First word: ${words[0]}"

-e	Use readline (for editable input, history, etc.) — interactive use only
# Let’s say you want to prompt the user for a filename, but let them autocomplete:
read -e -p "Enter the filename: " filename
echo "You selected: $filename"
# Now if they start typing ~/Doc and press Tab, it'll autocomplete to ~/Documents (if it exists).

-d delim	Read until delimiter instead of newline (Bash 4+)

-u fd	Read from file descriptor fd

```

```
echo "Linux:is:awesome." | (IFS=":" read -r var1 var2 var3; echo -e "$var1 n$var2 n$var3")
Linux
is
awesome.
```

Чтобы указать строку приглашения, используйте параметр -p . Подсказка печатается перед выполнением read и не включает новую строку.

```
read -r -p "Are you sure?"

while true; do
    read -r -p "Do you wish to reboot the system? (Y/N): " answer
    case $answer in
        [Yy]* ) reboot; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer Y or N.";;
    esac
done
```

Если сценарий оболочки просит пользователей ввести конфиденциальную информацию, например пароль, используйте параметр -s который сообщает read не печатать ввод на терминале:

```
read -r -s -p "Enter your password: "
```

Чтобы присвоить слова массиву вместо имен переменных, вызовите команду read с параметром -a :

```
read -r -a MY_ARR <<< "Linux is awesome."

for i in "${MY_ARR[@]}"; do
  echo "$i"
done
```
