# propmpt and concatenate

```
echo 'string 1'
read str1

echo 'string 2'
read str2

if (( $str1 == $str2 )) 
then
  echo "Strings are equal"
else
  echo "Strings are not equal"
fi

c=$str1$str2
echo $c
```
