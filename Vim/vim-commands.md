#regexp
s/a.*$// - удаление всего после символа а

#movements
w - next word start
b - previous word start
e - next word end
ge - previous word end

# revert
zz -save and quit

# jumps(by search with /)
'' - jump back to the last position
` - jump back to the last cursor position
ctrl+o - jump back to the last cursor position
ctrl+i - jump forward to the last cursor position
80% - jump to 80% of the file

# go
^ - start of line
0 - start of line (first character)
( - start of sentence (separated by . or ! or ?)
{ - start of paragraph (separated by blank lines)
ctrl+f - forward one page
ctrl+b - backward one page
ctrl+u - up half page
ctrl+d - down half page

# insert
gi - start insert mode at last position
ctrl+o - go to normal mode make a command and go back to insert

# indent
- normal mode S




# delete
dG - удаление всех строк от текущей до последней
dgg - удаление всех строк от текущей до первой
d$ - удаление конца строки от текущей позиции
d^ - удаление начала строки до текущей позиции.
de - удаление до конца слова
insert mode
c-w - delete word
c-u - delete line
c-h - delete character

# yank
уG - копирование строк от текущей до конца файла
y$ - копирование части строки от курсора до конца строки
y^ - копирование части строки от курсора до начала строки

# change
#cw -изменение текущего слова
#cc - всей текущей строки
cG - всех строк файла от текущей до последней
cS -части строки от курсора до конца строки
с^ - части строки от курсора до начала строки.
g; Jump to the last change you made
g, Jump back forward through the change list
& Repeat last substitution on current line
g& Repeat last substitution on all lines

# visual 
`< Jump to beginning of last visual selection
`> Jump to end of last visual selection
va" - select with quotes
vi" - select inside quotes"
vis - select inside sentence
vip - select inside paragraph

# swap
xp Swap character forward
Xp Swap character backward

# spelling
z= Show spelling corrections
zg Add to spelling dictionary
zw Remove from spelling dictionary

# case 
~ Toggle case of current character
gUw Uppercase until end of word (u for lower, ~ to toggle)
gUiw Uppercase entire word (u for lower, ~ to toggle)
gUU Uppercase entire line
gu$ Lowercase until the end of the line


# file
:e! - отмена всех изменений в буфере с перезагрузкой в него файла с диска
:e файл - загрузка файла в буфер с замещением старого содержимого
:r файл - добавление содержимого файла после текущего положения курсора

# history
q: - command mode history
q/ - search history
q? - search history backward
q@ - repeat last macro

# indent
gg=G Reindent the whole file

# remove blank lines
:g/^$/d

# remove epty spaces
:%s/\s\{2,}/ /g

# command mode
If you mean from Vim command line I would do:

:normal 10GV20G
To past right after line 14 I would do:

:14put

# increment decrement
ctrl+v - visual block mode
ctrl+a - increment
ctrl+x - decrement
g ctrl+a - increment with decimal
g ctrl+x - decrement with decimal

# remove more than one space in file
:%s/\s\{2,}//g
