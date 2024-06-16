## delete first line
```
sed '1d' dummy.txt
```

## delete line 5
```
sed '5d' dummy.txt
```

## delete last line
```
sed '$d' dummy.txt
```

## range of lines
```
sed '1,5d' dummy.txt
```

## multiple lines
```
sed '1d;2d;3d;$d' dummy.txt
```

## multiple lines except range
```
sed '2,4!d' dummy.txt
```
## empty lines
```
sed '/^$/d' dummy.txt
```

## patern
```
sed '/the/d' dummy.txt
```

## patern multiple
```
sed '/brown\|the/d' dummy.txt
```

## starting with number
```
sed '/^[[:digit:]]/d' dummy.txt
```

## starting with multiple chars
```
sed '/^[tb]/d' dummy.txt
```

## starting with upper case
```
sed '/^[[:upper:]]/d' dummy.txt
```

## ending with specific char
```
sed '/e$/d' dummy.txt
```

## end with multiple chars
```
sed '/[en]$/d' dummy.txt
```

## pattern and next line
```
sed '/the/{N;d;}' dummy.txt
```

## pattern from the end
```
sed '/fox/,$d' dummy.txt
```

## delete special char
```
sed ‘s/\#//g’ ch.txt
```

## delete few special char
```
sed ‘s/[#$%*@]//g’ file.txt
```

## from line 2 and 3
```
sed ‘2s/[#@]//g; 3s/[%*]//g’ newfile.txt
```


