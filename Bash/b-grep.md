### grep

### grep flags
```
-i - case insensitive
-v - invert match
-c - count
-e - pattern
-n - line number
-l - file name
-r - recursive
-w - word match
```


### grep options
```
\<text - word start with text
text\> - word end with text
^ - start of line
$ - end of line
[a-z] - any character in the range a to z
[^a-z] - any character not in the range a to z
. - any character
a|z - a or z

```

### grep examples

#### search for a word in a file
```
grep -i "text" file
```

#### search for a word in all files in a directory
```
grep -i "text" *
```

#### search for a word in all files in a directory recursively
```
grep -i "text" -r *
```
