
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
