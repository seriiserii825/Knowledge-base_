find -name "\*.flac" -exec ffmpeg -i {} -acodec libmp3lame -ab 320k {}.mp3 \;
