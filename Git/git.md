## Temporary keep changes

### git stash

- `git stash` - stash changes in the working directory
- `git stash push -m "message"` - stash changes with a message
- `git stash list` - list all stashes
- `git stash apply` - apply the latest stash
- `git stash apply stash@{n}` - apply the nth stash
- `git stash pop` - apply the latest stash and remove it from the stash list
- `git stash pop stash@{n}` - apply the nth stash and remove it from the stash list
- `git stash drop` - remove the latest stash from the stash list
- `git stash drop stash@{n}` - remove the nth stash from the stash list
- `git stash clear` - remove all stashes

## Remove in git

### remove file from git

```bash
git ls-files
git rm --cached filename
git clean -n - show untracked files
git clean -f filename - untracked files
git clean -fd - untracked files and directories
```

### remove changes from git, reset to the last commit

```bash
git checkout .
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

## Restore deleted commit or branch

### get back deleted commit

git reset --hard HEAD~1 - delete the last commit
git reflog - show all the commits
git reset --hard <commit-hash>`

### remove branch localy and remotely

```bash
git branch -d <branch-name> - delete local branch
git push origin --delete <branch-name> - delete remote branch
```

### get back deleted branch

```bash
git checkout -b <branch-name> <commit-hash>
git checkout master
git baranch -D <branch-name>
git reflog - show all the commits
git checkout <commit-hash>
git checkout -b <branch-name>

```

## made a mistake in old commit, and want to undo it

- git add -a -m "commit message with mistake"
- git new commit
- git new commit
- git new commit
- git new commit
- git new commit
- git new commit
- git revert <commit hash>
- will create a new commit that undoes the changes of the specified commit

## remove a file from git
```bash
git ls-files
git rm --cached filename
```

## remove folder from git
```bash
git rm -r --cached foldername
```

## remove all changes from git
```bash
git checkout .
```

