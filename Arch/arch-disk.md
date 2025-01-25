## fat32
sudo pacman -S dosfstools mtools

format usb
sudo mkfs.msdos -F 32 /dev/sdd1

Если у вас несколько дисков, а вы хотите установить на какой-то конкретный, то можно посмотреть диски по размерам.

```
fdisk -l
```

![](https://habrastorage.org/r/w1560/webt/ad/1h/do/ad1hdomavwqct4dhepwm2ygs1vk.png)
Время размечать наш диск. Используем команду _cfdisk_ для этого и выбираем _gpt_ формат :

```
cfdisk /dev/sda
```

![](https://habrastorage.org/r/w1560/webt/1s/bz/z7/1sbzz7td9fjl6vwshzxfd-i_4vi.png)
**_Bажно!_** если во время использования команды _lsblk_ и _fdisk_ вы увидели что sda является не тем диском, что нужен вам, то вы дописываете в конец название другого диска, например _sdb_.
Используя стрелочки создаём 3 раздела на диске:

- /dev/sda1 # размером 1G места под UEFI
- /dev/sda2 # размером примерно 10-15 GB под root
- /dev/sda3 # всё оставшееся место под директорию home
  _PS: Если вы решили переделать разметку диска, то через эту утилиту можно и удалять разделы_
  Для проверки используем _lsblk_ снова. Если всё норм, что _/dev/sda_ будет содежать в себе 3 раздела.

---

Далее форматируем наши разделы.

1. Форматируем тот раздел, который мы выделили под **UEFi**
   ```
   mkfs.fat -F32 /dev/sda1
   ```
2. Раздел root
   ```
   mkfs.ext4 /dev/sda2
   ```
3. Раздел home
   `    mkfs.ext4 /dev/sda3
   `
   Монтируем _root_ и создаём папку _home_:

```
mount /dev/sda2 /mnt
mkdir /mnt/home
mount /dev/sda3 /mnt/home
```

И снова _lsblk_ для проверки  
![](https://habrastorage.org/r/w1560/webt/qk/ey/yy/qkeyyy6nuwm7dfa-kkdvr6hvijs.png)
