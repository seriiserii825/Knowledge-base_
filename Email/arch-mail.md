# Почта в Arch без браузера: mailnag + Thunderbird

Проблема: чтобы проверить почту, приходилось каждый раз открывать браузер и смотреть расширение Gmail.

Решение:

- **mailnag** — демон без окна. Следит за ящиками по IMAP IDLE и показывает уведомление (через `dunst`) с отправителем и
  темой.
- **Thunderbird** — почтовый клиент, все ящики в одном окне.

Ящики: Gmail, Яндекс, Hostinger (все по IMAP).

---

## 0. На другой машине (например, на работе)

Через git синхронизируются только i3-конфиги (`~/dotfiles`), список пакетов (`go-arch`) и этот файл.
Настройки mailnag (`~/.config/mailnag/`), профиль Thunderbird (`~/.thunderbird/`) и пароли в gnome-keyring — **локальные**,
ящики добавляются заново.

- [ ] Подтянуть изменения:
  ```
  cd ~/dotfiles && git pull
  cd ~/Documents/go/go-arch && git pull && go install .
  cd ~/Documents/Knowledge-base_ && git pull
  ```
- [ ] Обновить систему и поставить пакеты (без `-Syu` бывает 404 с зеркала — устаревшая база пакетов):
  ```
  sudo pacman -Syu
  go-arch mail
  ```
- [ ] Проверить keyring (mailnag хранит там пароли): `pgrep -al gnome-keyring`.
- [ ] mailnag: `mailnag-config` → те же три ящика (п. 3), **сразу включить Push-IMAP** у Яндекса и Hostinger.
- [ ] Thunderbird: Gmail через вход в Google, Яндекс и Hostinger вручную (п. 4).
- [ ] Пароли те же: пароль приложения Яндекса можно использовать на нескольких машинах, новый не нужен.
- [ ] Применить i3: `i3-msg reload` и `mailnag &` (или перезайти в i3 — mailnag стартует сам).
- [ ] Проверить: тестовое письмо → уведомление, `$mod+i` → Thunderbird на 10-м столе.

---

## 1. Установка

Пакеты добавлены в `go-arch` (`packages/profile/shared/pacman.csv` и `yay.csv`, группа `mail`, пункт меню `mail`).

- [ ] Установить пакеты (спросит пароль sudo):
  ```
  go-arch mail
  ```
  или вручную:
  ```
  sudo pacman -S --needed thunderbird
  yay -S --needed mailnag
  ```
- [ ] Проверить, что всё поставилось:
  ```
  pacman -Q thunderbird mailnag
  ```

---

## 2. Пароли приложений

У Gmail и Яндекса обычный пароль для IMAP не работает — нужен отдельный **пароль приложения**.

| Почта     | IMAP                     | SMTP                     | Пароль               |
| --------- | ------------------------ | ------------------------ | -------------------- |
| Gmail     | `imap.gmail.com:993`     | `smtp.gmail.com:465`     | пароль приложения    |
| Яндекс    | `imap.yandex.com:993`    | `smtp.yandex.com:465`    | пароль приложения    |
| Hostinger | `imap.hostinger.com:993` | `smtp.hostinger.com:465` | обычный пароль ящика |

- [x] **Gmail:** включить двухфакторную аутентификацию → https://myaccount.google.com/apppasswords → создать пароль
      (имя, например, `aerc`) → сохранить.
- [x] **Яндекс:** Почта → Настройки (шестерёнка) → All settings → **Email clients** → включить «From the imap.yandex.com
      server via IMAP». Способ авторизации — «App passwords and OAuth tokens» (включён по умолчанию, серый).
- [x] **Яндекс:** там же нажать ссылку **App passwords** (или https://id.yandex.ru/security/app-passwords, или
      id.yandex.ru → Security → прокрутить до App passwords) → тип **Mail** → имя, например, `aerc` → создать →
      сохранить (показывается один раз).
- [x] **Hostinger:** пароль приложения не нужен — используется обычный пароль ящика (тот же, что для входа в webmail).
      Если забыл: https://hpanel.hostinger.com → **Emails** → выбрать домен → **Email accounts** → `⋮` у ящика →
      **Change password**.
- [x] Сохранить пароли в `pass`, чтобы не держать их в конфигах открытым текстом:
  ```
  pass insert mail/gmail
  pass insert mail/yandex
  pass insert mail/hostinger
  ```

---

## 3. mailnag — уведомления

- [x] Проверить, что работает хранилище паролей (mailnag хранит пароли через Secret Service). `gnome-keyring`
      установлен, демон должен быть запущен:
  ```
  pgrep -al gnome-keyring
  ```
  Если пусто — добавить в i3 (см. п. 5) `exec --no-startup-id gnome-keyring-daemon --start --components=secrets`.
- [x] Открыть настройки:
  ```
  mailnag-config
  ```
- Вкладка **Accounts**: пустое белое поле — это список аккаунтов. Кнопки `+` / `−` / карандаш — в маленьком тулбаре в
  самом **низу** списка (если не видно — окно уходит за экран: `$mod+Shift+Space` или `$mod+f`). Warning'и
  `Gtk-CRITICAL ... WIDGET_REALIZED_FOR_EVENT` в терминале — безвредны.

  Список **Account type** (из `/usr/lib/python3.*/site-packages/Mailnag/configuration/accountdialog.py`): `Gmail`,
  `GMX`, `Web.de`, `Yahoo`, `IMAP (Custom)`, `POP3 (Custom)`, `MBox (Custom)`, `Maildir (Custom)`. Яндекса и Hostinger в
  списке нет → для них **IMAP (Custom)**.

  |              | Gmail             | Яндекс            | Hostinger            |
  | ------------ | ----------------- | ----------------- | -------------------- |
  | Account type | `Gmail`           | `IMAP (Custom)`   | `IMAP (Custom)`      |
  | User         | полный email      | полный email      | полный адрес ящика   |
  | Password     | пароль приложения | пароль приложения | пароль ящика         |
  | Server       | подставится сам   | `imap.yandex.com` | `imap.hostinger.com` |
  | Port         | подставится сам   | `993`             | `993`                |
  | SSL          | —                 | вкл               | вкл                  |
  | Push-IMAP    | —                 | **вкл**           | **вкл**              |

  **Enable Push-IMAP** — включить, иначе письма проверяются раз в `poll_interval` (10 мин), а не сразу.
  Логин Яндекса — адрес именно того аккаунта, в котором создан пароль приложения и включён IMAP
  (проверить в `~/.config/mailnag/mailnag.cfg`, строка `user =`; пароли там пустые — они в gnome-keyring).

- [x] `+` → добавить Gmail.
- [x] `+` → добавить Яндекс.
- [x] `+` → добавить Hostinger.
- [x] Вкладка **Plugins** → включить **LibNotify Notifications** (уведомления в dunst).
- [x] Включить mailnag: синий переключатель в **левом верхнем углу** окна `mailnag-config` (слева от вкладок Accounts /
      Plugins) — должен быть синим, кружок справа. Отдельной кнопки «Сохранить» нет — настройки сохраняются при закрытии
      окна (крестик).
- [x] Запустить демон в отдельном терминале и проверить, что нет ошибок подключения:
  ```
  mailnag
  ```
  Потом Ctrl+C.
- [x] Отправить себе тестовое письмо → должно появиться уведомление.

---

## 4. Thunderbird — чтение почты

(Сначала пробовал `aerc` в терминале — отказался, Thunderbird проще.)

- [ ] Установить:
  ```
  go-arch mail
  ```
  или `sudo pacman -S --needed thunderbird`.
- [ ] Запустить `thunderbird` → мастер «Настроить существующий адрес» (Аккаунт → Добавить → Почта).
- [ ] **Gmail:** ввести адрес → Thunderbird сам найдёт настройки и откроет окно входа Google (OAuth2).
      Пароль приложения тут **не нужен** — просто войти в Google.
- [ ] **Яндекс:** имя, адрес `seriiburduja@yandex.ru`, пароль — **пароль приложения** → «Настроить вручную», если
      сам не нашёл:
      входящая IMAP `imap.yandex.com:993` SSL/TLS, исходящая SMTP `smtp.yandex.com:465` SSL/TLS, аутентификация
      «Обычный пароль», логин — полный адрес.
- [ ] **Hostinger:** адрес `sergiu@bludelego.it`, пароль ящика. Если автонастройка не сработала — вручную:
      `imap.hostinger.com:993` SSL/TLS, `smtp.hostinger.com:465` SSL/TLS.
- [ ] Отправить себе тестовое письмо с каждого ящика (проверить и SMTP).
- [ ] Уведомления: Thunderbird сам показывает их, **только пока запущен**. mailnag (п. 3) работает без открытого
      Thunderbird — оставить его или отключить (переключатель в `mailnag-config`), чтобы не было двойных
      уведомлений.

### Thunderbird: отметить прочитанным

| Что | Как |
| --- | --- |
| Одно письмо (прочитано ⇄ непрочитано) | выделить → `M`, или клик по точке у темы (зелёная — не прочитано, серая — прочитано) |
| Несколько писем | выделить `Ctrl+клик` / `Shift+клик` → `M`, или ПКМ → **Mark → As Read** |
| Вся папка | открыть папку → `Shift+C`, или ПКМ по папке слева → **Mark Folder Read** |
| Ветка (тред) | `R` |
| За период | `C` → выбрать даты |

Отметки синхронизируются по IMAP с сервером — в вебе и на телефоне письма тоже станут прочитанными.

---

## 5. i3: автозапуск mailnag и биндинг Thunderbird

Схема: **mailnag** в автозапуске присылает уведомления всегда (окна нет, `$mod+q` его не закроет).
**Thunderbird** открывается только когда нужно почитать: у него нет трея, закрытие окна (`$mod+q`) завершает программу,
и без него Thunderbird уведомлений не шлёт.

- [x] `~/dotfiles/.config/i3/autostart` (после Telegram):
  ```
  exec --no-startup-id mailnag
  ```
  (`~/.config/autostart/mailnag.desktop` от `mailnag-config` в i3 не срабатывает — нет `dex`.)
- [x] `~/dotfiles/.config/i3/keyboard` — `$mod+i` (inbox): запустить Thunderbird, если не запущен, и перейти на 10-й стол:
  ```
  bindsym $mod+i exec --no-startup-id pgrep -x thunderbird >/dev/null || thunderbird, workspace 10
  ```
  `$mod+m` занят mpv, `$mod+e` — rofimoji.
- [x] `~/dotfiles/.config/i3/workspaces` — Thunderbird всегда на 10-м столе (как Telegram на 7-м):
  ```
  assign [class="org.mozilla.Thunderbird"] 10
  ```
- [x] `i3-msg reload`.
- [ ] Проверить: пришло письмо → уведомление от mailnag → `$mod+i` → письмо в Thunderbird.
- [ ] При следующем входе в i3: `pgrep -af mailnag` → процесс есть.

---

## Диагностика

- Нет уведомлений → запустить `mailnag` в терминале и смотреть ошибки. Частое: `authentication failed` — нужен пароль
  приложения, а не обычный пароль.
- mailnag не запоминает пароли → не запущен `gnome-keyring-daemon` (см. п. 3).
- Яндекс не подключается → не включён IMAP в настройках почты (Email clients), или используется обычный пароль вместо
  пароля приложения. `imap.yandex.ru` и `imap.yandex.com` — один и тот же сервер.
- Проверить, работают ли уведомления вообще: `notify-send test` → должно появиться окно dunst.
