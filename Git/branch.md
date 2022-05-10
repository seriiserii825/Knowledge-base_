 git branch -a
 
for b in `git branch -a | cut -c18- | cut -d\  -f1`; do git checkout $b; git stash; done
