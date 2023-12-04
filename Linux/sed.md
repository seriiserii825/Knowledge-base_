To modify sed commands’ behavior, add the following command-line options:

- **–help** – prints command usage information.
- **–debug** – enables Terminal to annotate program execution and input.
- **\-i** – overwrites the original file.
- **\-n** – disables automatic printing unless the user uses the **p** command.
- **\-u** – minimizes output.
- **–posix** – disables POSIX sed extensions to simplify writing portable scripts.
- **\-e** – specifies multiple commands to run sequentially.
- **\-b** – opens input files in binary mode.
- **\-l** – sets the desired line-wrap length for the **l** command.

The **script** contains the subcommand, search pattern, replacement string, and flag. These elements are encapsulated in apostrophes and separated using a delimiter, like a slash (**/**), backslash (**\\**), or pipe (**|**).

Their order may differ depending on the subcommand. For example, the **s** or **substitute** command replaces a [regular expression](https://www.regular-expressions.info/) pattern with another string. Here’s the syntax:

's/regex_pattern/new_pattern/flags'

To alter the pattern substitution, use the following flags:

- **g** – applies global replacement, not just the first occurrence.
- **Number** – specifies which line numbers to modify.
- **p** – prints the new line after a successful pattern replacement.
- **i** – makes the substitution case sensitive.

### Using sed to Replace the nth Occurrence of a Pattern in a Line

If a pattern in a line occurs multiple times, enter the following command syntax to replace a specific one:

```

sed 's/old\_string/new\_string/#' samplefile.txt
```

Substitute the hash (#) symbol with the pattern’s sequence number. For example, this command replaces the first occurrence of the word **“music”** with **“song”** in a line inside the **playlist.txt** file:

```

sed 's/music/song/1' playlist.txt
```

### Using sed to Replace an Occurrence From nth to All Occurrences in a Line

Instead of replacing all patterns within the same line, combine the number and **g** flag to replace occurrences starting from a specific one. Here’s the sed script:

```

sed 's/old\_string/new\_string/#g' samplefile.txt
```

For example, the command below replaces the word **“pisces”** with **“aquarius”** from the second occurrence until the last one in the **astrology.txt** file.

```

sed 's/pisces/aquarius/2g' astrology.txt
```

### Using sed to Replace the String on a Specific Line Number

To replace the string on an nth line, add its sequence number before **s** like this syntax:

```

sed '#s/old\_string/new\_string/' samplefile.txt
```

For example, enter the following to substitute the word **“cake”** with **“bread”** in the second line of **foods.txt**:

```

sed '2s/cake/bread/' foods.txt
```

### Using sed to Duplicate the Replaced Line With the /p Flag

To print lines that your sed command modified as an additional output, use the **p** or **print** flag. Here’s the general syntax:

```

sed 's/old\_string/new\_string/p' samplefile.txt
```

For example, run the following to replace **“phones”** with **“tablets”** in the **gadgets.txt** file and print the results:

```

sed 's/phones/tablets/p' gadgets.txt
```

### Using sed to Replace the String of a Range of Lines

The sed command lets you modify only the line numbers specified in the script by adding the range. Here’s the syntax:

```

sed '#,# s/old\_string/new\_string/' samplefile.txt
```

For example, the command below replaces **“germany”** located in the third, fourth, and fifth line on the **countries.txt** file with **“france”**:

```

sed '3,5 s/germany/france/' countries.txt
```

### Using sed to Print Only the Replaced Lines

By default, the stream editor prints the entire file content. To simplify the output, combine the **\-n** option with the **p** command to show only the matching lines. Here’s the general syntax:

```

sed -n 's/old\_string/new\_string/p' samplefile.txt
```

For example, to replace the third instance of **“green”** with **“blue**“ in a line inside the **colors.txt** file and print the modified lines on the terminal window, enter:

```

sed -n 's/green/blue/3p' colors.txt
```

### Using sed to Delete Lines From a Particular File

The **d** or **delete** command lets you remove lines from a file without a text editor. For example, use the following syntax to remove a particular line number:

```

sed '#d' samplefile.txt
```

Replace the hash (#) symbol with the line number you want to delete. For example, run this command to remove the first line from the **cities.txt** file:

```

sed '1d' cities.txt
```

In addition, you can delete all the lines within a specific range using the sed command:

```

sed '#,#d' samplefile.txt
```

Replace the hash (#) symbols with the starting and ending line numbers. For example, enter the following to delete the first to the third line in the **cars.txt** file:

```

sed '1,3d' cars.txt
```

You can also delete the last line in a file by combining the **d** subcommand and a dollar sign ($), like the following.

```

sed '$d' samplefile.txt
```

To delete a specific line number starting from the last one, use the following syntax:

```

sed '#,$d' samplefile.txt
```

For example, this command will remove the second to last line in the **books.txt** file:

```

sed '2,$d' books.txt
```

In addition to deleting lines, use this command to remove a particular occurrence in a file. To do so, specify the regex pattern in your script, like the following syntax:

```

sed '/pattern/d' samplefile.txt
```

For example, run this to remove the **“oabo”** pattern from the **filestrings.txt** file:

```

sed '/oabo/d' filestrings.txt
```

### Use sed for Batch Processing of Files

Generally, there are two ways to edit files in bulk using the sed command.

First, specify the files individually. With this method, you will list all the input files you want to replace at the end of your command, separated using spaces. Here’s the syntax:

```

sed 's/old_string/new_string/g' filename1.txt filename2.txt
```

The command will simultaneously find and replace all old_string occurrences in the two text files.

Second, scan them using the find command. This method automatically searches for files containing the specified pattern in a directory. Here’s the syntax:

```

find /directory/path/file -type f -exec sed -i 's/old_string/new_string/g' {} \;
```
