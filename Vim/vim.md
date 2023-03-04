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

