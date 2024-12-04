### Concatenating Files with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#concatenating-files-with-the-cat-command "Direct link to heading")

This command also lets you concatenate multiple files into a single one. Basically it functions exactly like the redirection feature above, but with multiple source files.

```
cat source1.txt source2.txt > destination.txt
```

Like earlier, the above command will create the destination file if it does not exist, or overwrite an existing one with the same name.

### Highlighting Line Ends with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#highlighting-line-ends-with-the-cat-command "Direct link to heading")

The cat command can also mark line ends by displaying the **$** character at the end of each line. To use this feature, use the **\-E** option along with cat command:

```
cat -E filename.txt
```

### Display Line Numbers with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#display-line-numbers-with-the-cat-command "Direct link to heading")

With the cat command you can also display the contents of a file along with line numbers at the beginning of each one. To use this feature, use the **\-n** option with cat command:

```
cat -n filename.txt
```

### Displaying Non-Printable Characters with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#displaying-non-printable-characters-with-the-cat-command "Direct link to heading")

To display all non-printable characters use the **\-v** option along with cat command like in the following example:

```
cat -v filename.txt
```

To display tab characters only, use **\-T**:

```
cat -T filename.txt
```

The tab characters will be shown as **^I**

### Suppressing Empty Lines with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#suppressing-empty-lines-with-the-cat-command "Direct link to heading")

To suppress repeated empty lines, and safe space on your display you can use the **\-s** option. Keep in mind that this option will keep one blank line by removing the repeated empty lines only. The command would look like this:

```
cat -s filename.txt
```

### Numbering Non-Empty Lines with the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#numbering-non-empty-lines-with-the-cat-command "Direct link to heading")

To display non-empty lines with line numbers printed before them use the **\-b** option. Remember the  **\-b** option will override the **\-n** option:

```
cat -b filename.txt
```

### Displaying a File in Reverse Order With the Cat Command[​](https://linux-docs.vercel.app/docs/linux-basics/cat-command-usage-and-examples#displaying-a-file-in-reverse-order-with-the-cat-command "Direct link to heading")

To view the contents of a file in reverse order, starting with the last line and ending with the first, just use the **tac** command, which is just cat in reverse:

```
tac filename.txt
```
