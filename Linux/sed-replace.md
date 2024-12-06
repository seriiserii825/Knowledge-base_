## scss variable with css
```

find . -name "*.scss" -type f -exec sed -i 's/\$\(.*\)/var(--\1)/g' {} +
```

## replace
```
sed -i 's/the/THE/g' sed-practice.txt
```

## replace with delimeter
```
sed -i 's/\/bin\/bash/\/usr\/bin\/zsh/g' sed-practice.txt
```

## print
```
sed -n '/ACER/p' laptops.txt
```

## from upper to lower
```
sed 's/[A-Z]/\L&/g' upper.txt
```

## from upper to lower specific words
```
sed 's/[S,D,U]/\L&/g' upper.txt
```

## from lower to upper
```
sed 's/[a-z]/\U&/g' lower.txt
```

## from lower to upper specific
```
sed 's/[L,D,F]/\U&/g' lower.txt
```

## first letter to upper
```
sed 's/\b\(.\)/\u\1/g' names.txt
```


