# vim flash remote

y,d,v + r + symbol

## comment lines

### one line

```vim
gc+r+symbol+v+enter
```

### 2 lines by default

```vim
gc+r+symbol+enter
```

### n lines

```vim
gc+r+symbol+n+j(down)
```

## copy from tag or a word

```vim
y,r, symbol, w - copy word
y,r, symbol, it - copy inner tag
y,r, symbol, at - copy around tag
y,r, symbol, i{ - copy inner {}
```

## delete line

```vim
d,r,symbol,_
```

## change func arg

```vim
c,r,symbol,ci(
```

## Копировать до конца файла от выбранной метки

```vim
y r <метка> G
```

## Удалить до ближайшего совпадения Regex другой части буфера

```vim
d r <метка> /TODO
```

## Удалить текст между двумя метками в разных местах

```vim
d r <метка1> /<endTag>
```

Удаляете от метки1 до <endTag> в другом месте.

## Изменить (заменить) строку, выполнив substitute, используя remote

```vim
c r <метка> 0r: s/old/new/g\<CR>
```
