## source
https://github.com/dynobo/normcap?tab=readme-ov-file
https://www.youtube.com/watch?v=Ytwvc70wIJc&t=245s&ab_channel=PythonToday

## install packages
sudo apt install build-essential tesseract-ocr tesseract-ocr-eng libtesseract-dev libleptonica-dev wl-clipboard

## download app
wget https://github.com/dynobo/normcap/releases/download/v0.5.4/NormCap-0.5.4-x86_64.AppImage

## create app file in system
nvim ~/.local/share/applications/normcap.desktop

## desktop app
[Desktop Entry]
Version=1.0
Name=Normcap
Comment=Start Normcap
Exec=~/.local/bin/NormCap-0.5.4-x86_64.AppImage
Icon=/usr/share/icons/hicolor/128x128/apps/firefox.png
Terminal=true
Type=Application
