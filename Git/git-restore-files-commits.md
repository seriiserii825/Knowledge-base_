# Restore files and commits in Git

## get back deleted commit

git reset --hard HEAD~1 - delete the last commit
git reflog - show all the commits
git reset --hard <commit-hash>`

## get back deleted branch

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
