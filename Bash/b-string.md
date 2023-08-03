# toogle case

```
st1 = 'some'

echo ${st1^} - lowercase
echo ${st1^^} - uppercase
echo ${st1^l} - first letter upper
```

# replace first occurience

```
string="Welcome to bash script."
echo $string
string=$(sed "s/bash/shell/" <<< "$string")
echo $string
```

## replace all ocurrience

```
string="Welcome to bash script.
This is a new bash script line.
This is another new bash script line."
echo $string
string=$(sed "s/bash/shell/g" <<< "$string")
echo $string
```

## get element from path

```
$ cat filelist.txt
./first/example1/path
./second/example1/path
./third/example2/path

$ cut -d/ -f2 filelist.txt
first
second
third

$ cut -d/ -f3 filelist.txt
example1
example1
example2
```
