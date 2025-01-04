## git detach HEAD

```
git branch(will see branchname and detached HEAD)
when you are in detached HEAD state, you can checkout to a branch to attach HEAD to a branch
git checkout branchname
```

## detached made a changes and want to save it
```
git checkout -b newbranchname
git add .
git commit -m "message"
git checkout master
git merge newbranchname
```
