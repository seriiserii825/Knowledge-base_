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
