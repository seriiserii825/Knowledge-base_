# 1. Клонировать старый репозиторий полностью

```

git clone --mirror OLD_REPO_URL
cd repo.git
```

# 2. Создать пустой репозиторий в Bitbucket

# 3. Залить всё в Bitbucket

```

git clone --mirror git@bitbucket.org:blueline-wordpress-sites/ar-storm.git
cd ar-storm.git

git remote set-url origin git@bitbucket.org:blueline-front-projects/ar-storm.git

git push --mirror
git push --mirror transfers the complete Git history, all branches, tags, and refs.

```
