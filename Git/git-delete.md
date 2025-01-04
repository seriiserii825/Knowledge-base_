## remove file from git
```bash
git ls-files
git rm --cached filename
```

## remove changes from git, reset to the last commit
```bash
git checkout .
```

## remove commit
```bash
// remove the last commit but keep the changes, can rename commit
git reset --soft HEAD~1 
// remove the last commit and changes
git reset --hard HEAD~1 
```

## remove branch
```bash
git branch -d branchname
```
