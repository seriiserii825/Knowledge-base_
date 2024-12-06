**1.** The first example shows how to find out all the `.png` images and archive them using the [tar utilit](https://www.tecmint.com/18-tar-command-examples-in-linux/)y as follows.

Here, the action command `-print0` enables printing of the full file path on the standard output, followed by a null character and `-0` xargs flag effectively deals with space in filenames.

$ find Pictures/tecmint/ -name "\*.png" -type f -print0 | xargs -0 tar -cvzf images.tar.gz

![Find Images and Archive Using Tar](https://www.tecmint.com/wp-content/uploads/2018/08/Find-Images-and-Archive-Using-Tar.png)

Find Images and Archive Using Tar

**2.** You can also convert muti-line output from [ls command](https://www.tecmint.com/tag/linux-ls-command/) into single line using **xargs** as follows.

$ ls -1 Pictures/tecmint/
$ ls -1 Pictures/tecmint/ | xargs

![List Files in Single Line](https://www.tecmint.com/wp-content/uploads/2018/08/List-Files-in-Single-Line.png)

List Files in Single Line

**3.** To generate a compact list of all Linux user accounts on the system, use the following command.

$ cut -d: -f1 < /etc/passwd | sort | xargs

![Find List of Linux Users](https://www.tecmint.com/wp-content/uploads/2018/08/Find-List-of-Linux-Users.png)

Find List of Linux Users

**4.** Assuming you have a list of files, and you wish to know the number of **lines/words/characters** in each file in the list, you can use [ls command](https://www.tecmint.com/tag/linux-ls-command/) and **xargs** for this purpose as follows.

$ ls \*upload\* | xargs wc

![Count Number of Lines, Words and Characters in Files](https://www.tecmint.com/wp-content/uploads/2018/08/Count-Number-of-Lines-Words-and-Characters-in-Files.png)

Count Number of Lines, Words and Characters in Files

**5.** Xarags also allows you to find and recursively remove a directory, for example the following command will recursively remove **DomTerm** in the directory **Downloads**.

$ find Downloads -name "DomTerm" -type d -print0 | xargs -0 /bin/rm -v -rf "{}"

![Find and Recursively Delete Directory](https://www.tecmint.com/wp-content/uploads/2018/08/Find-and-Recursively-Delete-Directory.png)

Find and Recursively Delete Directory

**6.** Similarly to the previous command, you can also finds all files named **net_stats** in the current directory and delete them.

$ find . -name "net_stats" -type f -print0 | xargs -0 /bin/rm -v -rf "{}"

**7.** Next, use **xargs** to copy a file to multiple directories at once; in this example we are trying to copy the file.

$ echo ./Templates/ ./Documents/ | xargs -n 1 cp -v ./Downloads/SIC_Template.xlsx

![Copy File to Multiple Directories](https://www.tecmint.com/wp-content/uploads/2018/08/Copy-File-to-Multiple-Directories.png)

Copy File to Multiple Directories

**8.** You can also use the [find command](https://www.tecmint.com/35-practical-examples-of-linux-find-command/), **xargs** and [rename](https://www.tecmint.com/rename-multiple-files-in-linux/) commands together to to rename all files or subdirectories in a particular directory to lowercase as follows.

$ find Documnets -depth | xargs -n 1 rename -v 's/(.\*)\\/(\[^\\/\]\*)/\\\\/\\L$2/' {} \\;

**9.** Here is another useful usage example for **xargs**, it shows how to delete all files within a directory except one or few files with a given extension.

$ find . -type f -not -name '\*gz' -print0 | xargs -0 -I {} rm -v {}

**10.** As mentioned earlier, you can instruct **xargs** to read items from a file instead of standard input using the `-a` flag as shown.

$ xargs -a rss_links.txt

**11.** You can enable verbosity using the `-t` flag, which tells **xargs** to print the command line on the standard error output before executing it.

$ find Downloads -name "DomTerm" -type d -print0 | xargs -0 -t /bin/rm -rf "{}"

**12.** By default, **xargs** terminates/delimits items using blank spaces, you can use the `-d` flag to set the delimiter which may be a single character, a C-style character escape such as `\n`, or an octal or hexadecimal escape code.

In addition, you can also prompt the user about whether to run each command line and read a line from the terminal, using the `-p` flag as shown (simply type `y` for **yes** or `n` for **no**).

$ echo ./Templates/ ./Documents/ | xargs -p -n 1 cp -v ./Downloads/SIC_Template.xlsx

![Prompt User Before Running Command](https://www.tecmint.com/wp-content/uploads/2018/08/Prompt-User-Before-Reading-Input-and-Running-Command.png)
