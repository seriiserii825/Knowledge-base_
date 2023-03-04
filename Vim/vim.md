#======================= Command line
#copy
:281t. – Copy line 281 and paste it below the current line
:-10t. – Copy the line 10 lines above the current line and paste it below the current line
:10,20t. – Copy lines 10 to 20 and paste them below
:+8t. – Copy the line 8 lines after the current line and paste it below
:t20 – Copy the current line and paste it below line 20

#move
:m 12	move current line to after line 12
:m 0	move current line to before first line
:m $	move current line to after last line
:m 'a	move current line to after line with mark a (see using marks)
:m 'a-1	move current line to before line with mark a
:m '}-1	move current line to the end of the current paragraph
For clarity, a space is shown after the :m commands above, but that space is not required.
To move a block of lines, use the same command but visually select the lines before entering the move command. You can also use arbitrary ranges with the move command. Examples:
:5,7m 21	move lines 5, 6 and 7 to after line 21
:5,7m 0	move lines 5, 6 and 7 to before first line
:5,7m $	move lines 5, 6 and 7 to after last line
:.,.+4m 21	move 5 lines starting at current line to after line 21
:,+4m14	same (. for current line is assumed)

#yank
Visual
:normal 10GV20G

#paste
Paste from buffer
:normal 14Gp
:12pu

#norm
:%norm csw"A: "",

#========================== Visual mode
gv Reselect the last visual selection
`< Jump to beginning of last visual selection
`> Jump to end of last visual selection


#============== Toggle Case
gUw Uppercase until end of word (u for lower, ~ to toggle)
gUiw Uppercase entire word (u for lower, ~ to toggle)
gUU Uppercase entire line
gu$ Lowercase until the end of the line

#=========== Go to changes
g; Jump to the last change you made
g, Jump back forward through the change list
<C-o> - jump back
<C-i> - jump forward

#========= Scroll screen
<ctrl-f> – Move viewport forward one full screen (mnemonic: “Forward”)
<ctrl-b> – Move viewport backwards one full screen (mnemonic: “Backward”)
<ctrl-d> – Move viewport down one half screen (mnemonic: “Down”)
<ctrl-u> – Move viewport up one half screen (mnemonic: “Up”)

#========== Undo 
<C-u> - in insert mode

#========== Argdo
:args path/to/file/glob/*.js

Next, you perform the substitution across those files:
:argdo %s/pattern/replacement/g

Finally, save all the files:
:argdo update

#============ Move lines
nnoremap <M-j> :m .+1<CR>==
nnoremap <M-k> :m .-2<CR>==
inoremap <M-j> <Esc>:m .+1<CR>==gi
inoremap <M-k> <Esc>:m .-2<CR>==gi
vnoremap <M-j> :m '>+1<CR>gv=gv
vnoremap <M-k> :m '<-2<CR>gv=gv

#====== Git
The tool that has become most essential to my workflow is a set of mappings provided by the Unimpaired plugin to jump to the next conflict marker:

]n goes to the next conflict marker
[n goes back to the previous conflict marker
You can also use these with d to delete until the next marker or delete back to the previous marker. This makes quick work of picking which half of the conflict you wish to keep.

d]n delete till the next conflict marker
d[n delete back to the previous conflict marker

#======== Search
/move
<C-g> - next occurience
<C-t> - next occurience

#======= Duplicate
" duplicate line in normal mode:
nnoremap <C-D> Yp
" duplicate line in insert mode:
inoremap <C-D> <Esc> Ypi
