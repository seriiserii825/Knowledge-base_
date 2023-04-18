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

# pull all
git branch -r | grep -v '\->' | while read remote; do git branch --track "${remote#origin/}" "$remote"; done
git fetch --all
git pull --all

and after made and checkout to branch
