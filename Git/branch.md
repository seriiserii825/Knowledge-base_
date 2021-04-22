### Выводим список веток
```
git branch
```

### Создаем ветку
```
git branch branch
```

### Создаем ветку и переходим на нее
```
git checkout -b branch
```
### Удалить ветку
```
$ git push -d <remote_name> <branch_name>
$ git branch -d <branch_name>
```

### Merge and show all commits on branches
```
git merge feature --no-ff
```
### Clone all branch
```
git branch -r | grep -v '\->' | while read remote; do git branch --track "${remote#origin/}" "$remote"; done
git fetch --all
git pull --all
```
# Rename the local branch to the new name
git branch -m <old_name> <new_name>

# Or shorter way to delete remote branch [:]
git push <remote> :<old_name>

# Push the new branch to remote
git push <remote> <new_name>

# Reset the upstream branch for the new_name local branch
git push <remote> -u <new_name>
