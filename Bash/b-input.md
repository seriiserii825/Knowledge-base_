### input(STDIN)
```
$0 - filename
echo $0 $1 $2

args=("$@") -- all arguments from terminal

echo ${args[0]} ${args[1]}

echo $# - print args length
```

### read file and print each line in terminal
```

while read line
do 
  echo "$line"
done < "${1:-/dev/stdin}"
```
