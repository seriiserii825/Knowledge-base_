### dir
```
echo "Enter dir name:"
read dir_name

mkdir -p $dir_name

if [ -d $dir_name ]
then
  echo "Directory exists"
else
  echo "Directory does not exist"
fi

```

### file
```
echo "Enter file name:"
read file_name

if [ -f $file_name ]
then 
  echo "File exists"
else
  touch $file_name
  echo "Append file to text"
  read file_text
  echo $file_text >> $file_name
  echo "File was created"
fi
```
