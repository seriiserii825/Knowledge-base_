# table
```
id name  age
1  John  23
2  Doe   45
3  Jane  34
4  Smith 56
```

# get first and last column
```
cut -f 1-3,10-13 table.txt
```

# by fields cat /etc/passwd

```
cut -d: -f1,3,6 /etc/passwd
```
