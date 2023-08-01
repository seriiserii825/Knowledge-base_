### while

```
myvar=1

while [ $myvar -le 10 ]
do
  echo $myvar
  myvar=$[ $myvar + 1 ]
  sleep 0.5
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
