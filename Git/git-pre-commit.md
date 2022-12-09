# create file
.git/hooks/pre-commit

# write inside
#!/bin/sh

branch="$(git rev-parse --abbrev-ref HEAD)"

if [ "$branch" = "master" ]; then
  echo "Master Branch commit is blocked"
  exit 1
fi

# add writes
sudo chmod +x pre-commit


