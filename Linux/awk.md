### print all file

```
awk '{print $0}' file
```

### print first word from each line

```
awk '{print $1}' file
```

### show column by delimeter

```
awk -F: '{print $1}' /etc/passwd
```

### change word

```

echo "One Two" | awk '{$2="Three";print $0}'
```

### print table 2 columns with title
```
FS - like -F choose delimiter
awk 'BEGIN {print "login \t home"; FS=":"} {print $1 "\t" $6}' /etc/passwd

OFS - change delimiter in output
awk 'BEGIN {FS=":"; OFS="/"} {print $1, $3, $6}' /etc/passwd
```


### Get file name from path
```
$NF - show last column
  echo $file_path | awk 'BEGIN{FS="/"}{print $NF}' | xclip -sel clip
```

### Arguments
```
ARGC - argument count
ARGV - argument value, [0] - argument, [1] - file
awk 'BEGIN {print ARGC, ARGV[1]}' /etc/passwd
awk 'BEGIN {print ENVIRON["HOME"]}' - show home directory path
```
