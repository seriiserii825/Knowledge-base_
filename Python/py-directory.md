## Get the directory name of a path
os.path.dirname("/path/to/file")


# List all subdirectories using scandir()
basepath = 'my_directory/'
with os.scandir(basepath) as entries:
    for entry in entries:
        if entry.is_dir():
            print(entry.name)

# make dir
os.mkdir('example_directory/')

## list just directories
current_dir = os.getcwd()
parent_dir = os.path.abspath(os.path.join(current_dir, '..'))
dirs = next(os.walk(parent_dir))[1]
for theme in dirs:
    print(theme)


### dir_path

```
downloads_dir = os.path.expanduser("~/Downloads")
```

### check if directory exists

```
    import os
directory_exists = os.path.isdir(project_name)
    ```

### copy directory
    ```
    from distutils.dir_util import copy_tree
copy_tree(PROJECT_STARTER, project_name)
    ```

### remove directory
    ```
    import shutil
    shutil.rmtree('.git')
    ```

### go to another directory
    ```
    import os
os.chdir(project_name)
    ```
