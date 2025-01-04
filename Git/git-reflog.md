## get back deleted commit
``
git reset --hard HEAD~1 - delete the last commit
git reflog - show all the commits
git reset --hard <commit-hash>
``

## get back deleted branch
```bash
git checkout -b <branch-name> <commit-hash>
git checkout master
git baranch -D <branch-name>
git reflog - show all the commits
git checkout <commit-hash>
git checkout -b <branch-name>

```
