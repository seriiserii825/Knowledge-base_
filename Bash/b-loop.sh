### while

```
  repos=("${(@f)$(< "$file_path")}")

  for line in "${repos[@]}"; do
    [[ -z "$line" ]] && continue

    if [[ ! -d "$line/.git" ]]; then
      echo "Not a Git repository: $line"
      continue
    fi

    echo "Processing repository: $line"

    cd "$line" || continue

    if [[ -n $(git status --porcelain) ]]; then
      echo "Uncommitted changes in $line:"
      gitPush $script_dir
    fi
  done
```

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

for (( i=0; i<10; i++ ))
do
  echo "Number: $i"
done
