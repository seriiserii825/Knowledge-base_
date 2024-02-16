### Shortcut to surround

````
let b:surround_{char2nr('c')} = "```\r```"
````

### Old text Command New text ~

```
"Hello *world!"           ds"         Hello world!
[123+4*56]/2              cs])        (123+456)/2
"Look ma, I'm *HTML!"     cs"<q>      <q>Look ma, I'm HTML!</q>
if *x>3 {                 ysW(        if ( x>3 ) {
my $str = *whee!;         vllllS'     my $str = 'whee!';"
```

### Rename tag to h2

```
cstth2
```

### Add

```
ys<motion>"
ysw" - add "word"

<h4>Teaching language:<h4>
yst<" surround from language to <
```

### Delete

```
ds" - delete "
<div>Yo!*</div>           dst         Yo!
```

### Change

```
cs"' - change " to '
```

### To add a `<h1>` around line

```
yss<h1>
```

### Wrap list with `ul`

```
Shifv+v then S<ul>
```

<ul>
