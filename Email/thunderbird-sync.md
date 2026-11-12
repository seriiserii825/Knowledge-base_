## Задача

Настроил аккаунты в Thunderbird дома — не хочется заново всё вводить на работе. Нужны только **аккаунты и пароли**
(настройки интерфейса не важны).

Профиль Thunderbird (159, Arch) лежит в `~/.config/thunderbird/<id>.default-release/` (не `~/.thunderbird`). Весит ~850
МБ — почти всё это кэш писем (`ImapMail`), плюс там пароли (`logins.*`, `key4.db`) и PGP-ключи → **весь профиль в git
класть нельзя**.

---

## Варианты, которые рассматривали

1. **Встроенный Export/Import** — `≡ → Tools → Export` (zip профиля, можно без писем) → на другой машине
   `Tools → Import → Thunderbird → zip`. Работает, но это разовый снимок.
2. **Sync через Mozilla account** — Thunderbird его делает; проверить в Settings, есть ли пункт Sync. Если есть — самый
   простой путь.
3. **`user.js` в dotfiles** — для настроек поведения/интерфейса (Thunderbird применяет его поверх `prefs.js` при каждом
   старте). Для аккаунтов/паролей не подходит.

Выбрал свою утилиту: только аккаунты + пароли, зашифровано gpg.

---

## Решение: `go-thunderbird`

Утилита: репо `~/Documents/go/go-thunderbird` (ставится через `go install .`). Хранилище лежит в самом репо и
шифруется по конвенции `.gpgrc` (`accounts.zip.gpg`, ключом `gpg -e -r $USER`, не паролем).

```bash
# на исходной машине (Thunderbird закрыт):
go-thunderbird export          # профиль → accounts/ → accounts.zip.gpg; потом commit + push

# на другой машине: один раз запустить Thunderbird (чтобы создался профиль), закрыть, pull:
go-thunderbird import          # accounts.zip.gpg → accounts/ → профиль
```

Подробности — `README.md` репозитория.

### Что переносится

- **Аккаунты** — строки из `prefs.js`: `mail.account.*`, `mail.accountmanager.*`, `mail.identity.*`,
  `mail.server.serverN.*`, `mail.smtpserver.*`, `mail.smtpservers`, `mail.smtp.*`, `mail.root.*`. Абсолютные пути
  (`mail.server.serverN.directory`, `mail.root.imap` и т.п.) выкидываются — остаются только `*-rel`
  (`[ProfD]ImapMail/...`). Поэтому неважно, как называется папка профиля на другой машине; письма Thunderbird заново
  скачает по IMAP.
- **Пароли и OAuth-токены** (Gmail): `logins.json`, `logins.db`, `logins-backup.json` + **`key4.db`** — ключ, которым
  они зашифрованы. Без `key4.db` пароли не расшифруются.
- Письма **не** переносятся.

### Как работает

- export: собирает `account-prefs.js` + папку `passwords/` в `<repo>/accounts/` (в `.gitignore`) →
  zip в памяти → `gpg -e -r $USER` → `accounts.zip.gpg` (строка в `.gpgrc`, совместимо с push/pull `go-lf`).
- import: расшифровывает `accounts.zip.gpg` в памяти в `accounts/`, делает бэкап текущих `prefs.js` и файлов паролей в `<профиль>/accounts-backup-<дата>/`,
  удаляет из `prefs.js` все account-строки и дописывает импортированные, заменяет файлы паролей целиком.
- Профиль ищется через `profiles.ini` (`[Install…] Default=`, иначе профиль с `Default=1`) в `~/.config/thunderbird`,
  `~/.thunderbird`, `~/.mozilla/thunderbird`. Можно указать вручную: `TB_PROFILE=/путь/к/профилю`.

### Грабли / важное

- **Thunderbird должен быть закрыт** и при export, и при import — `prefs.js` он пишет при выходе и перезатрёт изменения;
  `logins.db` — sqlite, открытый процессом. Утилита сама проверяет `pgrep` и отказывается работать.
- Import **заменяет** существующие аккаунты на целевой машине (не мержит). Откат: закрыть Thunderbird и скопировать
  файлы из `accounts-backup-<дата>/` обратно в профиль.
- В git коммитится только `accounts.zip.gpg`; `accounts/` (расшифрованные пароли) — в `.gitignore`, не коммитить.
- Шифрование ключом, а не паролем: на другой машине нужен тот же секретный gpg-ключ (`gpg.sh` → Export/Import key).

### Тест без пароля gpg (для отладки)

```bash
TB_PROFILE=/tmp/копия-профиля TB_NO_RUNNING_CHECK=1 \
GNUPGHOME=/tmp/тестовый-gnupg \
go-thunderbird -d /tmp/тестовый-repo -r testkey export
```
