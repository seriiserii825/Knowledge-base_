### check if have args

```
if [ ! $# -gt 0 ]; then
    echo "Insert one or * image name"
    exit 1
fi
```

### Number Comparisons:

```
-eq - is equal to - if [ "$a" -eq "$b" ]
-ne - is not equal to - if [ "$a" -ne "$b" ]
-gt - is greater than - if [ "$a" -gt "$b" ]
-ge - is greater than or equal to - if [ "$a" -ge "$b" ]
-lt - is less than - if [ "$a" -lt "$b" ]
-le - is less than or equal to - if [ "$a" -le "$b" ]
< - is less than - (("$a" < "$b"))
<= - is less than or equal to - (("$a" <= "$b"))
> - is greater than - (("$a" > "$b"))
>= - is greater than or equal to - (("$a" >= "$b"))
```

# test

### Examples:

```
[ n1 -eq n2 ] (true if n1 same as n2, else false)
[ n1 -ge n2 ] (true if n1greater then or equal to n2, else false) [ n1 -le n2 ] (true if n1 less then or equal to n2, else false) [ n1 -ne n2 ] (true if n1 is not same as n2, else false) [ n1 -gt n2 ] (true if n1 greater then n2, else false)
[ n1 -lt n2 ] (true if n1 less then n2, else false)
```

### String Comparisons:

```
= - is equal to - if [ "$a" = "$b" ]
== - is equal to - if [ "$a" == "$b" ]
!= - is not equal to - if [ "$a" != "$b" ]
< - is less than, in ASCII alphabetical order - if [["$a" < "$b"]]
> - is greater than, in ASCII alphabetical order - if [["$a" > "$b"]]
-z - string is null, that is, has zero length
```

### Examples:

```
[ s1 = s2 ] (true if s1 same as s2, else false)
[ s1 != s2 ] (true if s1 not same as s2, else false)
[ s1 ] (true if s1 is not empty, else false)
[ -n s1 ] (true if s1 has a length greater then 0, else false)
[ -z s2 ] (true if s2 has a length of 0, otherwise false)
```

### check for files

```
-s file is empty
-e exists file or dir
-f exists file
-d exists dir
-b exists block file
-c exists text file
-r read permision
-w write permision
```

