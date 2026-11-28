# Переключить домен в Cloudflare на новый VPS

Ситуация: домен уже в Cloudflare (nameservers прописаны в Namecheap, статус Active) и указывает на старый сервер. Нужно
перевести его на новый VPS.

В Namecheap ничего менять не нужно — все правки только в Cloudflare. Первичная настройка домена:
`11.vps-server-namecheap-cloudflare-vps.md`.

## 0. Подготовьте новый сервер заранее

До переключения DNS на новом сервере уже должно работать приложение и веб-сервер (Caddy/nginx), открыты порты в
файрволе:

```bash
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
# для LiveKit (если есть):
sudo ufw allow 7881/tcp
sudo ufw allow 7882/udp
```

Проверить, что приложение отвечает по IP (до DNS):

```bash
curl -I http://<NEW_IP>
# или с подстановкой домена, не трогая DNS:
curl -I --resolve seriiburduja.org:443:<NEW_IP> https://seriiburduja.org -k
```

Если `curl` сразу падает с `Failed to connect ... Could not connect to server` (за десятки мс) — на порту никто не
слушает (сервер пустой / веб-сервер не запущен). Таймаут вместо мгновенной ошибки — режет файрвол.

### Тестовая страница на пустом сервере

Если приложения ещё нет — поднимите заглушку, чтобы проверить сеть, файрвол и потом DNS:

```bash
mkdir -p ~/test-site
echo '<h1>Hello from new VPS</h1>' > ~/test-site/index.html

docker run -d --name test-site -p 80:80 \
  -v ~/test-site:/usr/share/nginx/html:ro nginx:alpine

curl -I http://localhost      # на сервере → 200 OK
curl -I http://<NEW_IP>       # с локальной машины → 200 OK
```

Когда настоящее приложение готово — убрать заглушку (освободить порт 80):

```bash
docker rm -f test-site
```

## 1. Узнайте IP нового сервера

```bash
dig +short vps-xxxxxxxx.vps.ovh.net        # IPv4
dig +short AAAA vps-xxxxxxxx.vps.ovh.net   # IPv6
```

Или на сервере:

```bash
curl -4 ifconfig.me
ip -6 addr   # глобальный адрес (не fe80::) — значит IPv6 есть
```

## 2. Сохраните текущие записи (на случай отката)

Cloudflare → домен → DNS → Records → **Export** (кнопка справа вверху / в меню "Import and Export"). Сохраните файл —
это бэкап зоны со старыми IP.

## 3. Замените IP в записях

DNS → Records → у каждой записи, которая указывает на старый IP → **Edit** → новый IP → Save.

Где это в интерфейсе Cloudflare:

1. Домен → в левом меню **DNS** (раскрывается, стрелка `>`) → **Records**. Или со страницы Overview — справа в блоке
   DNS ссылка **DNS Records**.
2. В поиске над таблицей ввести **старый IP** — останутся только записи, которые на него указывают.
3. У каждой записи **Edit** (справа в строке) → поле **IPv4 address** (у AAAA — **IPv6 address**) → новый IP →
   **Save**.
4. **Proxy status** не менять: 🟠 остаётся 🟠, ⚪ (`livekit`) — ⚪.

| Type | Name      | Было         | Стало        | Proxy       |
| ---- | --------- | ------------ | ------------ | ----------- |
| A    | `@`       | `<OLD_IP>`   | `<NEW_IP>`   | 🟠 Proxied  |
| A    | `www`     | `<OLD_IP>`   | `<NEW_IP>`   | 🟠 Proxied  |
| A    | `api`     | `<OLD_IP>`   | `<NEW_IP>`   | 🟠 Proxied  |
| A    | `livekit` | `<OLD_IP>`   | `<NEW_IP>`   | ⚪ DNS only |
| AAAA | `@`/`www` | `<OLD_IPv6>` | `<NEW_IPv6>` | 🟠 Proxied  |

Быстро найти все записи со старым адресом: в поиске над списком записей ввести старый IP.

### Важно про AAAA (IPv6)

Если у **нового** сервера IPv6 нет или он не настроен — **удалите** старые AAAA-записи, а не оставляйте их. Иначе часть
клиентов (и Cloudflare) будет ходить на старый сервер по IPv6. Удаление: у записи **Edit** → **Delete**.

### Не трогайте

- `MX`, `TXT` (SPF, DKIM, верификации Google и т.п.), `CNAME` на внешние сервисы — они не связаны с сервером.

## 4. SSL-сертификат на новом сервере

Режим SSL/TLS → Overview у домена, скорее всего, **Full (strict)**. Тогда пока на новом сервере нет валидного
сертификата, сайт будет отдавать ошибку **526 Invalid SSL certificate**.

Варианты:

**A. Caddy / certbot через Let's Encrypt (обычный путь)**

- Caddy получает сертификат сам при первом запросе, certbot — см. `13.vps-server-ssl.md`.
- HTTP-01 проверка через 🟠 прокси обычно проходит. Если не проходит — временно переключите запись на ⚪ DNS only,
  получите сертификат, верните 🟠.

**B. Cloudflare Origin Certificate**

- SSL/TLS → Origin Server → Create Certificate → положить cert + key на сервер в конфиг nginx/Caddy.
- Действует 15 лет, но доверяет ему только Cloudflare → подходит **только для 🟠 записей**. Для `livekit` (⚪ DNS only)
  нужен обычный Let's Encrypt.

**Не переключайте в "Flexible"**, чтобы "быстро заработало" — будет бесконечный редирект и трафик Cloudflare → сервер
пойдёт без шифрования.

## 5. Проверка

Для 🟠 записей смена IP применяется почти сразу (Cloudflare сам ходит к серверу). Для ⚪ DNS only — по TTL (Auto = 5
минут).

```bash
dig +short livekit.seriiburduja.org   # ⚪ → должен быть уже NEW_IP
dig +short seriiburduja.org           # 🟠 → IP Cloudflare, это нормально

curl -I https://seriiburduja.org       # 200 / 301, не 52x
curl -I https://api.seriiburduja.org
```

Что трафик реально идёт на новый сервер — смотрите логи на нём:

```bash
docker compose logs -f caddy     # или
sudo tail -f /var/log/nginx/access.log
```

Если локально всё ещё старый адрес — сбросить DNS-кэш (`resolvectl flush-caches`) или проверить через
`dig @1.1.1.1 ...`.

### Ошибки Cloudflare

| Код | Причина                                                             |
| --- | ------------------------------------------------------------------- |
| 521 | Сервер не отвечает: веб-сервер не запущен или порт 80/443 закрыт    |
| 522 | Таймаут: файрвол (ufw / панель провайдера) режет соединение         |
| 525 | SSL handshake не прошёл: на 443 нет TLS                             |
| 526 | Сертификат невалидный (самоподписанный/просрочен) при Full (strict) |

## 6. Старый сервер

- Подержите его включённым ещё 1–2 дня — на случай отката (вернуть старые IP в записях, см. бэкап из шага 2).
- Перенесите данные, которые остались на нём (БД, `uploads/`, `.env`).
- После этого отмените подписку / удалите сервер у старого провайдера, чтобы не продлился.
