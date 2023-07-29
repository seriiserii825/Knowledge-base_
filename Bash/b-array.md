### array

```
car=('BMW' 'Toyota' 'Honda')
echo "${car[@]}" # print all elements
echo "${car[0]}" # print first element
echo "${!car[@]}" # print all indexes
echo "${#car[@]}" # print length of array
unset car[2] # remove element from array
car[2]='Mercedes' # add element to array
echo "${car[@]}" # print all elements
```
