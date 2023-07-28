### while

```
number=1
while [ $number -lt 10 ]
do
    echo "$number"
    number=$(( number+1 ))
done

```

### for

```
for i in 1 2 4 6
for i in {1..10..2} 2 - increment

for i in {1..10}
for (( i=0; i<5; i++ ))
do
    echo "Hello World $i"
done
```

### break

```
for (( i=0; i<10; i++ ))
do
  if(( $i == 5 ))
  then
    break
  fi
    echo "Hello World $i"
done

```

