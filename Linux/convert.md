sudo apt-get install flac lame
find . -name '\*.flac' -exec sh -c 'flac -cd "{}" | lame - "{}".mp3' \;

avconv -i <sourcefile> -c:v libx264 -crf 23 output.mp4
