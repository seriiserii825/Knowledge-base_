# nmap

Сканер сети: находит живые хосты, открытые порты, сервисы и их версии, ОС.

> Сканировать только свои сети/хосты или те, на которые есть разрешение. Сканирование чужой инфраструктуры может считаться атакой.

## Установка

```bash
sudo pacman -S nmap        # Arch
sudo apt install nmap      # Debian/Ubuntu
```

Многие типы сканов (`-sS`, `-sU`, `-O`) требуют root — без `sudo` nmap молча откатывается на `-sT` (полный TCP connect).

## Синтаксис

```bash
nmap [тип скана] [опции] <цели>
```

## Цели

```bash
nmap 192.168.1.10                 # один хост
nmap example.com                  # по имени
nmap 192.168.1.10 192.168.1.20    # несколько
nmap 192.168.1.1-50               # диапазон
nmap 192.168.1.0/24               # подсеть
nmap -iL hosts.txt                # из файла (по одной цели на строку)
nmap 192.168.1.0/24 --exclude 192.168.1.1
```

## Обнаружение хостов (кто живой)

```bash
nmap -sn 192.168.1.0/24     # только ping-скан, без портов — "кто в сети"
nmap -Pn 192.168.1.10       # не пинговать, считать хост живым (если ICMP режется файрволом)
nmap -sL 192.168.1.0/24     # просто список целей + reverse DNS, без пакетов к хостам
nmap -n ...                 # не делать DNS-резолв (быстрее)
```

## Порты

```bash
nmap -p 22 host              # один порт
nmap -p 22,80,443 host       # список
nmap -p 1-1000 host          # диапазон
nmap -p- host                # все 65535
nmap -p U:53,T:22,80 host    # UDP и TCP вместе (с -sU -sS)
nmap -F host                 # fast: топ-100 портов
nmap --top-ports 20 host     # топ-N популярных
```

По умолчанию сканируются топ-1000 TCP-портов.

## Типы сканирования

| Флаг  | Что делает                                                      |
|-------|-----------------------------------------------------------------|
| `-sS` | SYN ("полуоткрытый"), дефолт под root. Быстрый, не завершает handshake |
| `-sT` | TCP connect — полный handshake, дефолт без root                  |
| `-sU` | UDP (медленно; DNS, DHCP, SNMP и т.п.)                           |
| `-sA` | ACK — выяснить, фильтрует ли файрвол порты                       |
| `-sV` | определить сервис и его версию на открытых портах                |
| `-O`  | определить ОС                                                    |
| `-A`  | агрессивный: `-sV -O -sC --traceroute` разом                     |
| `-sC` | дефолтные NSE-скрипты (= `--script=default`)                     |

## Состояния портов

- `open` — сервис принимает соединения
- `closed` — порт доступен, но там никто не слушает
- `filtered` — ответа нет / режется файрволом, nmap не может понять
- `unfiltered` — доступен, но open/closed не определить (бывает при `-sA`)
- `open|filtered`, `closed|filtered` — неоднозначно (часто у UDP)

## Скорость

```bash
nmap -T4 host     # шаблоны тайминга -T0 (паранойя) ... -T5 (безумно быстро); -T3 дефолт, -T4 норм для LAN
nmap --min-rate 1000 host          # не меньше N пакетов/сек
nmap --max-retries 1 host
nmap --host-timeout 30s host
```

## NSE-скрипты

Скрипты лежат в `/usr/share/nmap/scripts/`.

```bash
nmap -sC host                                # дефолтный набор
nmap --script http-title -p 80,443 host      # конкретный скрипт
nmap --script "http-*" host                  # по маске
nmap --script vuln host                      # категория (vuln, safe, discovery, auth, brute...)
nmap --script ssl-enum-ciphers -p 443 host   # шифры TLS
nmap --script-help http-title                # описание скрипта
ls /usr/share/nmap/scripts | grep smb        # поиск скриптов
```

## Вывод

```bash
nmap -v host           # подробнее (-vv ещё подробнее)
nmap --open host       # показывать только открытые порты
nmap --reason host     # почему порт в таком состоянии
nmap -oN out.txt host  # обычный текст
nmap -oX out.xml host  # XML
nmap -oG out.gnmap host # grep-friendly
nmap -oA scan host     # все три формата: scan.nmap, scan.xml, scan.gnmap
```

Во время скана: `Enter`/пробел — показать прогресс, `v`/`V` — +/- verbosity, `d`/`D` — debug.

## Частые рецепты

```bash
# Кто есть в моей локалке
sudo nmap -sn 192.168.1.0/24

# То же + MAC-адреса и вендоры (только в своей L2-сети, нужен root)
sudo nmap -sn 192.168.1.0/24 | grep -E "report|MAC"

# Что открыто у меня на машине
nmap localhost
sudo nmap -sS -p- localhost

# Быстрый полный скан хоста с версиями сервисов
sudo nmap -sS -sV -p- -T4 --open 192.168.1.10

# "Всё и сразу" по одному хосту
sudo nmap -A -T4 192.168.1.10

# Проверить, открыт ли конкретный порт
nmap -p 5432 db.local

# Какие веб-серверы есть в сети и их заголовки
nmap -p 80,443,8080 --open --script http-title 192.168.1.0/24

# Сертификат и шифры HTTPS
nmap -p 443 --script ssl-cert,ssl-enum-ciphers example.com

# UDP: DNS и DHCP
sudo nmap -sU -p 53,67 192.168.1.1

# Список живых IP одной колонкой
nmap -sn -n 192.168.1.0/24 -oG - | awk '/Up$/{print $2}'
```

## Смежное

- `ss -tulpn` / `netstat -tlpn` — какие порты слушает **своя** машина (см. `port.md`), без сетевого скана
- `ncat` (идёт в пакете nmap) — netcat: `ncat -zv host 22` проверить порт, `ncat -l 9000` слушать
- `nping` — генерация пакетов / ping по TCP/UDP
- `ndiff a.xml b.xml` — сравнить два скана (что поменялось)
- `man nmap`, https://nmap.org/book/man.html
