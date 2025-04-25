# check errors

```
exit 0
exit 1
if not type code status, will be previously executed command status

```

```
- exit status range from 0 to 255
0 = success
1 = general error
2 = misuse of shell builtins (according to Bash documentation)
use man or info to find mieaning exit status code

ls -l ~/Documents/some_dir
echo "$?" - equal to 2

if [ $? -eq 0 ]; then
    echo OK
else
    echo FAIL
fi
```

## ping google
```
host="google.meeet"
ping -c 1 $host
if [ $? -eq 0 ]; then
    echo "$host is reachable"
else
    echo "$host is not reachable"
fi
```
