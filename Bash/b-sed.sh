### sed

```
echo "Enter file name to search text from"
read file_name

if [ -f $file_name ]
then
    ## this command will not change the file, just show output
   sed 's/i/I/g' $file_name

   ## this command will change the file
   sed -i 's/i/I/g' $file_name
else
  echo "File '$file_name' does not exist"
fi
```

## rgba to rgba

```bash
find src -type f -name '*.scss' -exec sed -i -E '
s/(rgba?)\(([0-9]+)[ ]+([0-9]+)[ ]+([0-9]+)[ ]*\/[ ]*([0-9]+)%\)/\1(\2, \3, \4, 0.\5)/g;
s/(rgba?)\(([0-9]+)[ ]+([0-9]+)[ ]+([0-9]+)[ ]*\/[ ]*([0]*\.[0-9]+)\)/\1(\2, \3, \4, \5)/g;
s/(rgba?)\(([0-9]+)[ ]+([0-9]+)[ ]+([0-9]+)\)/\1(\2, \3, \4)/g
' {} +
```
