## git revert when made a mistake in old commit, and want to undo it
- git add -a -m "commit message with mistake"
- git new commit
- git new commit
- git new commit
- git new commit
- git new commit
- git new commit
- git revert <commit hash>
- will create a new commit that undoes the changes of the specified commit

