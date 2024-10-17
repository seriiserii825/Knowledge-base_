import os
# check if doesn't exists file with name 'front-page.php'
if not os.path.exists('front-page.php'):
    print('File does not exist')

# create file with name 'front-page.php'
os.system('touch front-page.php')

# Check if a path exists
os.path.exists("/path/to/directory")

# List files in a directory
os.listdir("/path/to/directory")

# Join paths
os.path.join("/path/to", "directory")

# Check if a path is a file or directory
os.path.isfile("/path/to/file")
os.path.isdir("/path/to/directory")

# Get the basename of a path
os.path.basename("/path/to/file")

# Split the path into its directory and basename
os.path.split("/path/to/file")

# loop through file
file1 = open('index.xml', 'r')
Lines = file1.readlines()
for line in Lines:
    if '<loc>' in line:
        url = line.split('<loc>')[1].split('</loc>')[0]
        urls = urls + (url,)

# Get the file info
download_dir = os.path.expanduser('~/Downloads')
with os.scandir(download_dir) as entries:
    for entry in entries:
        print(entry)
        print(entry.path)
        print(entry.stat())
        print(entry.name)

# List all just files in a directory using os.listdir
basepath = 'my_directory/'
for entry in os.listdir(basepath):
    if os.path.isfile(os.path.join(basepath, entry)):
        print(entry)

# List all files in a directory using scandir()
basepath = 'my_directory/'
with os.scandir(basepath) as entries:
    for entry in entries:
        if entry.is_file():
            print(entry.name)

import glob

# Find all Python files in a directory
python_files = glob.glob("/path/to/directory/*.py")
