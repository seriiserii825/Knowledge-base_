### Check commit

for project in `ls --color=never .`; do echo "=== $project ==="; git --git-dir="./$project/.git/" status; done

### Открыть commit в редакторе

```
git commit
```

### Сбросить изменения до комита

```
git checkout file
git checkout -- filename
```

## Сбросить до add

```
git checkout -- filename
```

## Сбросить измениения до add во всех файлах

```
git checkout -- .
```

## Если файл уже был добавлен в add

```
git reset filename
git checkout -- filename
```

## Если несколько файлов были добавлены в add

```
git reset .
git checkout -- .
```

### Удалить последний коммит полностью

```
git reset --soft HEAD^ #удалить коммит, но оставить изменения
git reset --hard HEAD^ #удалить коммит полностью
git push origin +HEAD # force-push the new HEAD commit
```

# Откатить изменения

git reset .
git reset --staged .
git clean -nd show files
git clean -fd remove fles
