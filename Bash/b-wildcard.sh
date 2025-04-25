## []
matches any of characters included between the brackets
match exact one character
```
ca[nt]* - matches any string that starts with ca, followed by either t or n, and then followed by any characters
can
cat
candy
catch
```

[!] - exclude characters
```
ca[!nt]* - matches any string that starts with ca, followed by any character except t or n, and then followed by any characters
cas
cap
```

### range
[a-g]* - all characters between a and g
[3-6]* - all numbers between 3 and 6

## clasess
[[:alpha:]] - all letters
[[:alnum:]] - all letters and numbers
[[:digit:]] - all digits
[[:lower:]] - all lowercase letters
[[:upper:]] - all uppercase letters
[[:space:]] - all whitespace characters

## escape \
```
*\? - end with ?
```



