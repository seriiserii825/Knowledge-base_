## install rofimojji
```bash
sudo pacman -S rofimoji
sudo pacman -S noto-fonts-emoji
```

## fallback font
```bash
mkdir -p ~/.config/fontconfig/conf.d/
nvim ~/.config/fontconfig/conf.d/10-emoji.conf


<?xml version="1.0"?>
<!DOCTYPE fontconfig SYSTEM "fonts.dtd">
<fontconfig>
  <match target="font">
    <test qual="any" name="family">
      <string>emoji</string>
    </test>
    <edit name="family" mode="prepend" binding="strong">
      <string>Noto Emoji</string>
    </edit>
  </match>
</fontconfig>
fc-cache -fv

echo -e "\U1F600 \U1F44D \U1F680"  # 😀 👍 🚀
```


