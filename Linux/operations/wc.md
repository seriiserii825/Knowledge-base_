1. Count Lines in a File
   wc -l file.txt

# Output: <number_of_lines> file.txt

2. Count Words in a File
   wc -w file.txt

# Output: <number_of_words> file.txt

3. Count Characters in a File
   wc -m file.txt

# Output: <number_of_characters> file.txt

4. Count Bytes in a File
   wc -c file.txt

# Output: <number_of_bytes> file.txt

5. Count Lines, Words, and Characters in a File
   wc file.txt

# Output: <lines> <words> <bytes> file.txt

6. Count Lines of Input from a Command
   ls | wc -l

# Output: <number_of_files_and_directories>

7. Count Words of Input from a Command
   echo "Hello world, Bash scripting!" | wc -w

# Output: 4

8. Count Words Across Multiple Files
   wc -w file1.txt file2.txt

# Output:

<words> file1.txt
<words> file2.txt
<total_words> total 9. Count Words from Standard Input
cat <<EOF | wc -w
This is a test input.
It contains multiple lines and words.
EOF

# Output: 10

10. Combine find with wc to Count Lines in Multiple Files
    find . -name "\*.txt" | xargs wc -l

# Output: <lines> <filename> (for each .txt file)
