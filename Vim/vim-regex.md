# Regexp

## remove attribute

```html
<div v-if="data.logos.ideal" class="promotion__logo">
  <img src="/images/logo-2.svg" alt="Logo 2" />
</div>
```

regexp:

```vim
:%s/img v-if="[^"]*"//
[^"]* - match any characters except double quotes
```

result:

```html
<div class="promotion__logo">
  <img src="/images/logo-2.svg" alt="Logo 2" />
</div>
```

## delete all after a character

```vim
s/a.\*$// - удаление всего после символа а
```

## remove blank lines

:g/^$/d

## remove empty spaces

:%s/\s\{2,}/ /g

## new line before

```vim
:g/^#/execute 'put! =""' | normal! k
```

Explanation:

```vim
:g/^#/ runs the command on every line that starts with #.
put! ="" inserts a blank line above.
normal! k moves the cursor back up to the # line so the next match is correctly handled.
```

## remove more than one space in file

:%s/\s\{2,}//g
