If you want to remove the 2 (two) last commits, there is an easy command to do that:

```
git reset --hard HEAD~2
```

You can change the `2` for any number of last commits you want to remove.

And to push this change to remote, you need to do a `git push` with the _force_ (`-f`) parameter:

```
git push -f
```

### Удалить последний коммит полностью

```
git reset --soft HEAD^ #удалить коммит, но оставить изменения
git reset --hard HEAD^ #удалить коммит полностью
git push origin +HEAD # force-push the new HEAD commit
git push --force
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

## gitignore
after add to gitignore rm
git rm -r --cached dir
git rm --cached filename
