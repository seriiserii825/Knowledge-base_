### if statement

```
eq - equal
ne - not equal
gt - greather then
lt - less then

count=11
if [ $count -eq 10 ]
then
  echo "Count is 10"
elif (( $count <=9 ))
  echo "<= 9"
else
  echo "Count is not 10"
fi

if (( $count > 9 ))
then
    echo 'some'
fi

if [ "$age" -gt 10 ] && [ "$age" -lt 20 ]
then
    echo "correct"
if

if [[ "$age" -gt 10  -a  "$age" -lt 20 ]]
then
    echo "correct"
if

```

Or operator

```
if [[ "$age" -gt 10  -o  "$age" -lt 20 ]]
then
    echo "correct"
if
```
