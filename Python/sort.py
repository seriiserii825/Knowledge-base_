import os
downloads_dir = os.path.expanduser("~/Downloads")
current_path = os.getcwd()
os.chdir(downloads_dir)
backup_files = os.listdir()
#sort by ctime in reverse order
backup_files.sort(key=lambda x: os.path.getctime(x), reverse=True)
os.chdir(current_path)
