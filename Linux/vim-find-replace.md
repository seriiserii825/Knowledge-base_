The :substitute command searches for a text pattern, and replaces it with a text string. There are many options, but these are what you probably want:

:s/foo/bar/g
Find each occurrence of 'foo' (in the current line only), and replace it with 'bar'.
:%s/foo/bar/g
Find each occurrence of 'foo' (in all lines), and replace it with 'bar'.
:%s/foo/bar/gc
Change each 'foo' to 'bar', but ask for confirmation first.
:%s/\<foo\>/bar/gc
Change only whole words exactly matching 'foo' to 'bar'; ask for confirmation.
:%s/foo/bar/gci
Change each 'foo' (case insensitive due to the i flag) to 'bar'; ask for confirmation.
:%s/foo\c/bar/gc is the same because \c makes the search case insensitive.
This may be wanted after using :set noignorecase to make searches case sensitive (the default).
:%s/foo/bar/gcI
Change each 'foo' (case sensitive due to the I flag) to 'bar'; ask for confirmation.
:%s/foo\C/bar/gc is the same because \C makes the search case sensitive.
This may be wanted after using :set ignorecase to make searches case insensitive.

The g flag means global – each occurrence in the line is changed, rather than just the first. This tip assumes the default setting for the 'gdefault' and 'edcompatible' option (off), which requires that the g flag be included in %s///g to perform a global substitute. Using :set gdefault creates confusion because then %s/// is global, whereas %s///g is not (that is, g reverses its meaning).

When using the c flag, you need to confirm for each match what to do. Vim will output something like: replace with foobar (y/n/a/q/l/^E/^Y)? (where foobar is the replacement part of the :s/.../.../ command. You can type y which means to substitute this match, n to skip this match, a to substitute this and all remaining matches ("all" remaining matches), q to quit the command, l to substitute this match and quit (think of "last"), ^E to scroll the screen up by holding the Ctrl key and pressing E and ^Y to scroll the screen down by holding the Ctrl key and pressing Y. However, the last two choices are only available, if your Vim is a normal, big or huge built or the insert_expand feature was enabled at compile time (look for +insert_expand in the output of :version).

# remove a and span tags

:% s/<\/\?\(li\|font\|a\)[^>]\*>//g

# remove all tags

:% s/<[^>]\*>//g

#remove blank lines
:g/^\s*$/d
^ begin of a line
\s* at least 0 spaces and as many as possible (greedy)
$ end of a line
