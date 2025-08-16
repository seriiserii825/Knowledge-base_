# vimgrep

```vim
:vimgrep /pattern/ % - search pattern in current file
:vimgrep /pattern/ *.txt - search pattern in all txt files
:vimgrep /pattern/ **/*.* - search pattern in all txt files in all directories
:cn - next
:cp - prev
@: - repeat last command
:cope - open the list of matches
```

## args

```vim
args **/*.css - search all css files in all directories
:vert sa args - open all buffers in vertical split
argdo %s/old/new/g - replace old with new in all files
window diff - compare all files
:vim /color/ ## - search color in all files from args
:cdo s/color/new/g - replace color with new in all files
```

## args example

```vim
:args app/**/*.php resources/**/*.php
:argadd `=split(system("find . -type f -name '*.php' -not -path './vendor/*'"), "\n")`
:vim /Hero/ ## - search Hero in all files from args
:cdo s/Hero/hero/g - replace Hero with hero in all files
```
