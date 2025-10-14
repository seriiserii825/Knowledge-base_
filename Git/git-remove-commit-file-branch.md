# Git remove commit, file, branch

## remove branch locally and remotely

```bash
git branch -d <branch-name> - delete local branch
git push origin --delete <branch-name> - delete remote branch
```

## remove a file from git

```bash
git ls-files
git rm --cached filename
git clean -n - show untracked files
git clean -f filename - untracked files
git clean -fd - untracked files and directories
```

### remove changes from git, reset to the last commit

```bash
git checkout . - discard all changes
git checkout filename - discard changes in a file
```

### remove commit

```bash
// remove the last commit but keep the changes, can rename commit
git reset --soft HEAD~1
// remove the last commit and changes
git reset --hard HEAD~1
```

### remove branch

```bash
git branch -d branchname
```

### remove remote branch

```bash
git push origin --delete branchname
```

## Checkout to new commit and want to save changes

### View detached HEAD

```
git branch(will see branchname and detached HEAD)
```

### leave detached HEAD

```
git checkout branchname
```

### detached made a changes and want to save it

```
git checkout -b newbranchname
git add .
git commit -m "message"
git checkout master
git merge newbranchname
git branch -d newbranchname
```
