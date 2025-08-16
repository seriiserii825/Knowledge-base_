# format table

```vim
:%!column -t

%!sed 's/","/\&/' | column -t -s '&'
```
