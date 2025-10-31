#!/bin/bash

file1_path=$( fzf )
file2_path=$( ls | grep -v $file1_path | fzf )

echo "file1_path: $file1_path"

# find jpg files
file_path=$(find . -maxdepth 1 -type f -iname "*.jpg" -printf "%f\n" | fzf --prompt="Select JPG: " --height=80% --reverse)

## find directories
dir_path=$(find . -type d 2>/dev/null | fzf --height 40% --reverse)
