### Rename last pushed commit

```bash
# Step 1: change the message (opens editor)
git commit --amend

#               or directly (no editor):
git commit --amend -m "fix: staff SEO title & description check + h1"

# Step 2: force-push  (most important part!)
git push --force-with-lease origin <branch-name>

# Example:
git push --force-with-lease origin master
# or if your branch is called feat/staff-seo
git push --force-with-lease origin feat/staff-seo
```

### If you want to remove the 2 (two) last commits, there is an easy command to do that:

```
git reset --hard HEAD~2
```

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
