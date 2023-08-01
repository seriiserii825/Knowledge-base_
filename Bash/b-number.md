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
