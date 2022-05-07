I believe your file type is php and your commentstring is /*%s*/ which is reasonable for php files.
To solve your problem you could temporarily change commentstring to<!--%s-->:

```
set commentstring='<!--%s-->'
```

or set the filetype to html

```
set ft=html
```

If you want to do that forever for php file you could add the following command:

```
setlocal commentstring='<!--%s-->'
```

To the vimfiles/after/ftplugin/php.vim file.
