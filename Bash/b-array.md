### array

```
os=('ubuntu' 'windows' 'kali')
echo "${os[@]}" # print all elements
echo "${!os[@]}" # print all indexes
echo "${#os[@]}" # print length of array

os[3]='mac' # add element at index 3
unset os[2] # remove element at index 2
```
