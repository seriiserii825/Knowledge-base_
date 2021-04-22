### Окончания строк
```
git config --global  cor.autocrlf iinput //linuc, mac
git config --global  cor.autocrlf true //lwindows
git config --global  cor.safecrlf true //safe mode
```
### Цвета
```
git config --global color.ui true
```
### Доступ к файлам
```
git/config filemode=false
```

### Просмотр всех настроек из gitconfig
```
git config --list
```

### Проверяем концы строк в файле
```
$ crlf index.js
index.js CRLF
```

### Конвертируем lf в crlf
```
$ crlf --set=LF *.js
index.js CRLF -> LF
test.js LF -> LF
```

### Проверяем
```
$ crlf index.js
LF
```
