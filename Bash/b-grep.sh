### grep

### search where
```
-r - recursive                          grep -r "text" .
-R - recursive + follow symlinks        grep -R "text" ~/.config
--include - only these files            grep -r --include="*.md" "text" .
--exclude - skip these files            grep -r --exclude="*.log" "text" .
--exclude-dir - skip dir                grep -r --exclude-dir=.git "text" .
```

### match
```
-i - case insensitive                   grep -i "text" file
-w - whole word                         grep -w "cat" file
-x - whole line                         grep -x "done" file
-v - invert (lines without match)       grep -v "#" file
-e - several patterns                   grep -e "foo" -e "bar" file
-f - patterns from file                 grep -f patterns.txt file
-E - extended regex (| + ? {})          grep -E "foo|bar" file
-F - fixed string, no regex             grep -F "a.b*c" file
-P - perl regex (\d, lookahead)         grep -P "\d{3}" file
```

### output
```
-n - line number                        grep -n "text" file
-l - only files with match              grep -rl "text" .
-L - only files without match           grep -rL "text" .
-c - count per file (shows :0 too)      grep -rc "text" . | grep -v ':0$'
-o - only matched part                  grep -o "[0-9]\+" file
-h - no file names                      grep -rh "text" .
-H - always file names                  grep -H "text" file
-m N - stop after N matches             grep -m 1 "text" file
-q - quiet, only exit status            grep -q "text" file && echo found
-s - no "No such file" errors           grep -s "text" *
--color - highlight                     grep --color=auto "text" file
```

### context
```
-A N - N lines after                    grep -A 2 "text" file
-B N - N lines before                   grep -B 2 "text" file
-C N - N lines before and after         grep -r -C 1 "text" .
```

### regex
```
^ - start of line                       grep "^#" file
$ - end of line                         grep "done$" file
. - any character                       grep "c.t" file
[a-z] - range                           grep "[0-9]" file
[^a-z] - not in range                   grep "[^a-z]" file
\<text - word starts with               grep "\<un" file
text\> - word ends with                 grep "ing\>" file
* - 0 or more                           grep "ab*c" file
a|b - a or b (with -E)                  grep -E "cat|dog" file
```

### examples
```
grep -rn "text" .                       # recursive with line numbers
grep -rli "text" .                      # file names, case insensitive
ps aux | grep -v grep | grep nginx      # filter command output
grep -v "^$" file                       # remove empty lines
grep -v "^#" file | grep -v "^$"        # config without comments
```
