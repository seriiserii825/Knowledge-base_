# Find

## Find with cp

```Bash

find . -path ./videos -prune -o -type f -name "*.mp4" -print
```

## find and copy

```Bash
find . -path ./videos -prune -o -type f -name "*.mp4" -exec cp "{}" videos/ \;
```

## find with rsync preserve directory structure

```Bash

find . -path ./videos -prune -o -type f -name "*.mp4" -exec rsync -R "{}" videos/ \;
```

## find with rsync

```Bash
find . -path ./videos -prune -o -type f -name "*.mp4" -print0 |
xargs -0 -I{} rsync --info=progress2 "{}" videos/
```
