# Pass на Android — полная настройка

## Требования

- Arch Linux с настроенным `gpg` + `pass` + `git`
- Android телефон
- Репозиторий паролей на GitHub

---

## 1. Исправить .gpg-id на компьютере

По умолчанию `pass init` мог записать имя вместо key ID. Исправляем:

\```bash

# Узнать короткий key ID

gpg --list-secret-keys --keyid-format short

# Переинициализировать хранилище с правильным key ID

pass init 90FA2450 # замени на свой short key ID

# Запушить изменения

cd ~/.password-store
git push
\```

---

## 2. Установить F-Droid на телефон

- Открыть на телефоне: https://f-droid.org
- Скачать и установить APK
- Разрешить установку из неизвестных источников

---

## 3. Установить приложения через F-Droid

Найти и установить:

- **Password Store** (by Android Password Store)

---

## 4. Экспортировать GPG ключ с компьютера

\```bash
gpg --export-secret-keys --armor 90FA2450 > ~/gpg-private.asc
\```

Перекинуть файл на телефон (USB, LocalSend и т.д.)

> ⚠️ После импорта сразу удалить файл с телефона и компьютера!

---

## 5. Импортировать GPG ключ на телефоне

В приложении Password Store:

- **Настройки → PGP settings → PGP key manager**
- Нажать **"+"** → выбрать `gpg-private.asc`
- Ввести passphrase от ключа
- Убедиться что ключ появился в списке

Удалить файл:
\```bash
rm ~/gpg-private.asc
\```

---

## 6. Настроить SSH ключ для git

\```bash

# Создать отдельный SSH ключ для телефона

ssh-keygen -t ed25519 -C "android-phone" -f ~/.ssh/id_ed25519_phone

# Показать публичный ключ

cat ~/.ssh/id_ed25519_phone.pub
\```

Добавить публичный ключ на GitHub:

- GitHub → Settings → SSH and GPG keys → **New SSH key** → вставить

Перекинуть приватный ключ на телефон, затем удалить:
\```bash
rm ~/.ssh/id_ed25519_phone # после импорта на телефоне
\```

В Password Store:

- **Настройки → Репозиторий → Authentication key → Импортировать SSH ключ**
- Выбрать файл `id_ed25519_phone`

---

## 7. Клонировать репозиторий на телефоне

В Password Store → настройка репозитория:
\```
URL: ssh://git@github.com/USERNAME/passwords.git
Тип авторизации: SSH key
\```

Нажать **Клонировать**

---

## Готово

Теперь пароли доступны на телефоне и синхронизируются через git.
