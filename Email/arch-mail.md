# Почта в Arch: mailnag + Thunderbird

- **mailnag** — демон без окна, следит за ящиками по IMAP и показывает уведомления (через `dunst`).
- **Thunderbird** — почтовый клиент, все ящики в одном окне.

Ящики: Gmail, Яндекс, Hostinger (все по IMAP).

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

- **Gmail:** https://myaccount.google.com/apppasswords (нужна 2FA).
- **Яндекс:** Почта → Настройки → Email clients → включить IMAP; пароль приложения —
  https://id.yandex.ru/security/app-passwords (тип **Mail**).

## 3. Настройка mailnag

mailnag хранит пароли в gnome-keyring — демон должен быть запущен (`pgrep -al gnome-keyring`).

```bash
mailnag-config
```

- Вкладка **Accounts** → `+` (внизу списка):

  |              | Gmail             | Яндекс            | Hostinger            |
  | ------------ | ----------------- | ----------------- | -------------------- |
  | Account type | `Gmail`           | `IMAP (Custom)`   | `IMAP (Custom)`      |
  | User         | полный email      | полный email      | полный адрес ящика   |
  | Password     | пароль приложения | пароль приложения | пароль ящика         |
  | Server       | —                 | `imap.yandex.com` | `imap.hostinger.com` |
  | Port         | —                 | `993`             | `993`                |
  | SSL          | —                 | вкл               | вкл                  |
  | Push-IMAP    | —                 | **вкл**           | **вкл**              |

- Вкладка **Plugins** → включить **LibNotify Notifications**.
- Включить переключатель в левом верхнем углу окна и закрыть окно (настройки сохраняются при закрытии).
- Автозапуск в i3 (`~/dotfiles/.config/i3/autostart`): `exec --no-startup-id mailnag`.

## 4. Настройка Thunderbird

`≡ → Account Settings → Account Actions → Add Mail Account`:

- **Gmail:** ввести адрес → вход через Google (OAuth), пароль приложения не нужен.
- **Яндекс:** адрес + пароль приложения. Если сам не нашёл — вручную по таблице из п. 2, SSL/TLS, «Обычный пароль».
- **Hostinger:** адрес + пароль ящика, при необходимости вручную по таблице из п. 2.

## 5. Перенос Thunderbird на другую машину

На исходной машине: `≡ → Tools → Export` → сохранить zip (письма можно не включать — скачаются по IMAP заново).

На другой машине: запустить Thunderbird один раз, затем `≡ → Tools → Import → Thunderbird → выбрать zip` →
перезапустить.

Импорт **заменяет** текущий профиль. В zip лежат пароли — не класть его в git.
