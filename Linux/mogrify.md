#install
sudo apt install imagemagick

#how to
From quick reading of this, apparently convert calls this option -flop for horizontal mirroring, and -flip for vertical. All I needed to do was

copy image

mogrify -flop copied-image.png 
