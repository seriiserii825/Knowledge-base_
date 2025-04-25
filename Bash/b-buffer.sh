#buffer to file
acf_path=$(touch ~/Downloads/acf.txt)
echo "$(xclip -o -selection clipboard)" > $acf_path

#file to buffer
xclip -sel clip < $acf_path
