### view snippets

```

ctrl+tab in insert mode
```
### snippet with code by default and transformation

```

snippet dv "simple html tag with register i and class" b
<${1:div} class="`!v eval('getreg("i")')`__$2">$3</${1/(\w+).*/$1/}>
endsnippet
```

### snippet with script

```
snippet todo "Todo reminder" b
<!-- TODO: `echo $USER` ${1:desc} `!v strftime('%c')`  -->
endsnippet
```
