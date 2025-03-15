#regexp
s/a.*$// - удаление всего после символа а

# movements
w - next word start
W - next word start (ignore punctuation)
b - previous word start
B - previous word start (ignore punctuation)
e - next word end
ge - previous word end
g_ Move the last non-blank character of the line (but you remove trailing whitespace, right)
ea Append to the end of the current word

## indent
`>3j - indent 3 lines`

## yank lines
y8j - yank 8 lines
yG - yank to the end of the file
ygg - yank to the beginning of the file

## delete word
d2w - delete 2 words

## delete chars
d8l - delete 8 characters

# revert
zz -save and quit

# jumps(by search with / or comment or substitute or marks)
'' - jump back to the last position
` - jump back to the last cursor position
ctrl+o - jump back to the last cursor position
ctrl+i - jump forward to the last cursor position
80% - jump to 80% of the file

# changes from insert mode
:changes - show changes
g; - jump to the last change in insert mode
g, - jump back forward through the change list


# go
^ - start of line
0 - start of line (first character)
( - start of sentence (separated by . or ! or ?)
{ - start of paragraph (separated by blank lines)
ctrl+f - forward one page
ctrl+b - backward one page
ctrl+u - up half page
ctrl+d - down half page

# delete
dG - удаление всех строк от текущей до последней
dgg - удаление всех строк от текущей до первой
d$ - удаление конца строки от текущей позиции
d^ - удаление начала строки до текущей позиции.
de - удаление до конца слова
da" Delete the next double-quoted string

# yank
уG - копирование строк от текущей до конца файла
y$ - копирование части строки от курсора до конца строки
y^ - копирование части строки от курсора до начала строки

# change
cw -изменение текущего слова
cc - всей текущей строки
cG - всех строк файла от текущей до последней
cS -части строки от курсора до конца строки
с^ - части строки от курсора до начала строки.
ci" Change what’s inside the next double-quoted string
ca{ Change outside the curly braces (try [, (, etc.)

## jump
g; Jump to the last change you made
g, Jump back forward through the change list
gi - start insert mode at last position
`< Jump to beginning of last visual selection
`> Jump to end of last visual selection

# visual 
va" - select with quotes
vi" - select inside quotes"
vis - select inside sentence
vip - select inside paragraph
o - visual mode toggle position

# spelling
z= Show spelling corrections
zg Add to spelling dictionary
zw Remove from spelling dictionary

# case 
~ Toggle case of current character
visual mode + gu or gU Lowercase or uppercase selection
gUU Uppercase entire line


# file
:e! - отмена всех изменений в буфере с перезагрузкой в него файла с диска
:e файл - загрузка файла в буфер с замещением старого содержимого
:r файл - добавление содержимого файла после текущего положения курсора

# history
q: - command mode history
q/ - search history
q? - search history backward
q@ - repeat last macro

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

## folding
zc Close current fold
zo Open current fold
za Toggle current fold
zi Toggle folding entirely

