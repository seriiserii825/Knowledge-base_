### while

```
colors="red green blue"
for color in $colors
do
  echo "Color: $color"
done
```

```
PICTURES=$(ls *.jpg)
DATE=$(date +%F)

for PICTURE in $PICTURES
do
  echo "Renaming picture to $DATE-$PICTURE"
  mv $PICTURE $DATE-$PICTURE
done
```

