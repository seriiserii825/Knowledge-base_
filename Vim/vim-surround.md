# delete

```vim
"Hello \*world!" ds" Hello world!
<div>Yo!*</div>           dst         Yo!
```

## change

```vim
"Hello *world!" cs"' 'Hello world!'
"Hello *world!" cs"<q> <q>Hello world!</q>
[123+4*56]/2 cs]) (123+456)/2
"Look ma, I'm \*HTML!" cs"<q> <q>Look ma, I'm HTML!</q>
```

## add

```vim
for word
Hello \*world! ysiw" "Hello" world!
for line
yss<h1> - h1 around line

around line with html tag
Hello world! yss<p> <p>Hello world!</p>
```

## visual add

```vim
my $str = \*whee!; vllllS' my $str = 'whee!';"
Shifv+v then S<ul>
```

## Rename tag to h2

```vim
cstth2
```
