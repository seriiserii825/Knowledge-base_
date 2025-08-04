# command mode

If you mean from Vim command line I would do:
:normal 10GV20G
To past right after line 14 I would do:
:14put
:78,40s/some/any/gic - i(case isensitive) c(ask for confirmation) I(case sensitive)
:22,28s/\<some\>/any/g - replace only whole words

## regexp

s/a.\*$// - удаление всего после символа а

## register

"0 - last yank
Ctrl+r+" - paste from register in insert mode
Ctrl+r a - paste from register a in insert mode
"ayiw - yank current word to register a"
"/p - paste directory name
"%p - past filename"

## new file

:e filename - open new file
:w filename - save file with new name

## sort

1,10sort - sort lines from 1 to 10
1,$sort - sort all lines
1,$sort! - sort all lines reverse
1,$sort u - sort all lines unique

## vimgrep

```
:vimgrep /pattern/ % - search pattern in current file
:vimgrep /pattern/ *.txt - search pattern in all txt files
:vimgrep /pattern/ **/*.* - search pattern in all txt files in all directories
:cn - next
:cp - prev
@: - repeat last command
:cope - open the list of matches
```

## args

```
args **/*.css - search all css files in all directories
:vert sa args - open all buffers in vertical split
argdo %s/old/new/g - replace old with new in all files
windo difft - compare all files
:vim /color/ ## - search color in all files from args
:cdo s/color/new/g - replace color with new in all files
```

## args example

```
:args app/**/*.php resources/**/*.php
:argadd `=split(system("find . -type f -name '*.php' -not -path './vendor/*'"), "\n")`
:vim /Hero/ ## - search Hero in all files from args
:cdo s/Hero/hero/g - replace Hero with hero in all files
```

# movements

w - next word start
W - next word start (ignore punctuation)
b - previous word start
B - previous word start (ignore punctuation)
e - next word end
ge - previous word end
g\_ Move the last non-blank character of the line (but you remove trailing whitespace, right)
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

# ` - jump back to the last cursor position

ctrl+o - jump back to the last cursor position
ctrl+i - jump forward to the last cursor position
80% - jump to 80% of the file

# changes from insert mode

:changes - show changes
g; - jump to the last change in insert mode
g, - jump back forward through the change list

## scroll

ctrl+f - forward one page
ctrl+b - backward one page
ctrl+u - up half page
ctrl+d - down half page
shift+h - scroll to first line on the screen
shift+m - scroll to middle line on the screen
shift+l - scroll to last line on the screen

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

# new line before

:g/^#/execute 'put! =""' | normal! k
Explanation:
:g/^#/ runs the command on every line that starts with #.
put! ="" inserts a blank line above.
normal! k moves the cursor back up to the # line so the next match is correctly handled.

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
zM Close all folds
za Toggle current fold
zi Toggle folding entirely
