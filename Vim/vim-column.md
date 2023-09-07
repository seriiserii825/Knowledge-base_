#format table
```
:%!column -t

%!sed 's/","/\&/' | column -t -s '&'
```

