### sum

```
n1=4
n2=6
echo $(( n1 + n2 ))
echo $(( n1 - n2 ))
echo $(( n1 * n2 ))
echo $(( n1 / n2 ))
echo $(( n1 % n2 ))
```

### floating

```
n1=20.5
n2=4
echo "$n1+$n2" | bc
echo "scale=2;$n1+$n2" | bc -- scale 0 after dots
```

### check number

```
re='^[0-9]+$'
if ! [[ $num =~ $re ]] ; then
   echo "error: Not a number" >&2; exit 1
fi
```

```bash
IFS=', ' read -r -a array <<< "$string"
```

