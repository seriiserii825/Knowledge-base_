sudo apt-get install flac lame
find . -name '\*.flac' -exec sh -c 'flac -cd "{}" | lame - "{}".mp3' \;
