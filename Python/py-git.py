from git import Repo

repo = Repo('.')
if repo.is_dirty() or len(repo.untracked_files) > 0:
    print('[green]Changes to commit')
else:
    print('[red]No changes to commit')
