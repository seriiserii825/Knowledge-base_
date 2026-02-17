### 1️⃣ Install SDDM

```bash
sudo pacman -S sddm
```

### 2️⃣ Disable LightDM

```bash
sudo systemctl disable lightdm
```

(Optional but cleaner)

```bash
sudo systemctl stop lightdm
```

### 3️⃣ Enable SDDM

sudo systemctl enable sddm

### 4️⃣ Reboot

```bash
reboot

```

### Themes live in:

```bash
/usr/share/sddm/themes/
```

### try themes

```

sddm-greeter-qt6 --test-mode --theme /usr/share/sddm/themes/maya
```
