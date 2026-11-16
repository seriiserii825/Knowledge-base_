# Монтирование нескольких дисков

## 1. Найти диски и их файловые системы

`lsblk` без флагов не показывает файловую систему — нужны явные колонки:

```bash
lsblk -o NAME,SIZE,TYPE,FSTYPE,LABEL,MOUNTPOINT,MODEL,TRAN,ROTA
```

или короче (режим для ФС, показывает FSTYPE/LABEL/UUID по умолчанию):

```bash
lsblk -f
```

Полезные колонки: `TRAN` (usb/nvme/sata — физическое подключение), `ROTA` (1 = HDD, 0 = SSD).

## 2. Создать точки монтирования и смонтировать

Для каждого диска — своя директория в `/mnt`:

```bash
sudo mkdir -p /mnt/disk1 /mnt/disk2

sudo mount -t ext4 /dev/sda1  /mnt/disk1
sudo mount -t ntfs3 /dev/nvme0n1p3 /mnt/disk2
```

**Зачем `-t`:** указывает ядру, каким драйвером читать раздел (ext4, ntfs3, vfat, xfs...). Для простых случаев (ext4) можно опустить — `mount` сам определит тип по суперблоку через `blkid`:

```bash
sudo mount /dev/sda1 /mnt/disk1
```

Для NTFS `-t` важнее — есть несколько драйверов (встроенный в ядро `ntfs3` vs старый FUSE `ntfs-3g`), автоопределение может выбрать не тот.

Только почитать, без риска записи — добавить `-o ro`:

```bash
sudo mount -t ntfs3 -o ro /dev/nvme0n1p3 /mnt/disk2
```

## 3. Проверить, что смонтировалось

```bash
lsblk -o NAME,MOUNTPOINT,SIZE,FSTYPE
```

## 4. Размонтировать

```bash
sudo umount /mnt/disk1 /mnt/disk2
```

## Подводные камни

- **NTFS-раздел от Windows не монтируется / только read-only**: если в Windows включён Fast Startup или гибернация, раздел помечен "грязным" (dirty). Решение — отключить Fast Startup в Windows и сделать нормальный shutdown, либо монтировать с `-o ro`.
- **Внешний HDD/SSD по USB** — определяется в `lsblk` как `TRAN usb`. Это физически внешний диск, в отличие от внутренних `nvme*` (`TRAN nvme`) — не путать при выборе, какой диск трогать.
