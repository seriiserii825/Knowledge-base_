# Почта в Arch: mailnag + Thunderbird

- **mailnag** — демон без окна, следит за ящиками по IMAP и показывает уведомления (через `dunst`).
- **Thunderbird** — почтовый клиент, все ящики в одном окне.

Ящики: Gmail, Яндекс, Hostinger, Mail.ru (все по IMAP).

## 1. Установка

```bash
go-arch mail
```

или вручную:

```bash
sudo pacman -S --needed thunderbird
yay -S --needed mailnag
```

## 2. Пароли

| Почта     | IMAP                     | SMTP                     | Пароль               |
| --------- | ------------------------ | ------------------------ | -------------------- |
| Gmail     | `imap.gmail.com:993`     | `smtp.gmail.com:465`     | пароль приложения    |
| Яндекс    | `imap.yandex.com:993`    | `smtp.yandex.com:465`    | пароль приложения    |
| Hostinger | `imap.hostinger.com:993` | `smtp.hostinger.com:465` | обычный пароль ящика |
| Mail.ru   | `imap.mail.ru:993`       | `smtp.mail.ru:465`       | пароль приложения     |

- **Gmail:** https://myaccount.google.com/apppasswords (нужна 2FA).
- **Яндекс:** Почта → Настройки → Email clients → включить IMAP; пароль приложения —
  https://id.yandex.ru/security/app-passwords (тип **Mail**).
- **Mail.ru:** id.mail.ru → Безопасность → «Пароли для внешних приложений» (нужна 2FA, тип приложения — почтовая
  программа).

## 3. Настройка mailnag

mailnag хранит пароли в gnome-keyring — демон должен быть запущен (`pgrep -al gnome-keyring`).

```bash
mailnag-config
```

- Вкладка **Accounts** → `+` (внизу списка):

  |              | Gmail             | Яндекс            | Hostinger            | Mail.ru          |
  | ------------ | ----------------- | ----------------- | -------------------- | ---------------- |
  | Account type | `Gmail`           | `IMAP (Custom)`   | `IMAP (Custom)`      | `IMAP (Custom)`  |
  | User         | полный email      | полный email      | полный адрес ящика   | полный email     |
  | Password     | пароль приложения | пароль приложения | пароль ящика         | пароль приложения|
  | Server       | —                 | `imap.yandex.com` | `imap.hostinger.com` | `imap.mail.ru`   |
  | Port         | —                 | `993`             | `993`                | `993`            |
  | SSL          | —                 | вкл               | вкл                  | вкл              |
  | Push-IMAP    | —                 | **вкл**           | **вкл**              | **вкл**          |

- Вкладка **Plugins** → включить **LibNotify Notifications**.
- Включить переключатель в левом верхнем углу окна и закрыть окно (настройки сохраняются при закрытии).
- Автозапуск в i3 (`~/dotfiles/.config/i3/autostart`): `exec --no-startup-id mailnag`.

## 4. Настройка Thunderbird

`≡ → Account Settings → Account Actions → Add Mail Account`:

- **Gmail:** ввести адрес → вход через Google (OAuth), пароль приложения не нужен.
- **Яндекс:** адрес + пароль приложения. Если сам не нашёл — вручную по таблице из п. 2, SSL/TLS, «Обычный пароль».
- **Hostinger:** адрес + пароль ящика, при необходимости вручную по таблице из п. 2.
- **Mail.ru:** встроенный OAuth-попап Thunderbird (`o2.mail.ru/xlogin`) у mail.ru **битый** — чекбокс «Work with
  Email using the IMAP protocol» не кликается (курсор `not-allowed`, задизейблен из-за проблем с JS во встроенном
  браузере Thunderbird). Обходной путь — настройка вручную с обычным паролем:
  1. На экране "Add your email address" нажать **MANUAL CONFIGURATION**.
  2. **Incoming (IMAP)**: `imap.mail.ru`, порт `993`, SSL/TLS, Authentication — **Normal password**.
  3. **Outgoing (SMTP)**: `smtp.mail.ru`, порт `465`, SSL/TLS, Authentication — **Normal password**.
  4. **Username**: полный адрес `...@mail.ru`.
  5. **Connect** → в поле пароля ввести **пароль приложения** (см. п. 2) — обычный пароль аккаунта не подойдёт.
  6. После успешного создания аккаунта Thunderbird второй раз откроет тот же битый OAuth-попап — уже для
     автообнаружения адресной книги/календаря (CardDAV/CalDAV), это необязательный шаг. На попапе жать **Cancel**,
     на окне позади — **Skip**. Почта (IMAP/SMTP) к этому моменту уже настроена и работает.

## 5. Перенос Thunderbird на другую машину

На исходной машине: `≡ → Tools → Export` → сохранить zip (письма можно не включать — скачаются по IMAP заново).

На другой машине: запустить Thunderbird один раз, затем `≡ → Tools → Import → Thunderbird → выбрать zip` →
перезапустить.

Импорт **заменяет** текущий профиль. В zip лежат пароли — не класть его в git.
