Для командного использования есть два подхода. Рекомендую симметричный ключ (shared keypair) — создать один GPG ключ и раздать его всем разработчикам.

Шаг 1 — Создать GPG ключ "blueline"

gpg --full-generate-key

Выбрать:

- Type: RSA and RSA
- Size: 4096
- Expiry: 0 (не истекает) или дату
- Name: blueline
- Email: например blueline@yourcompany.com
- Passphrase: придумать общую фразу для команды

Шаг 2 — Экспортировать ключ

# Публичный ключ (для шифрования)

gpg --export --armor blueline > blueline-public.gpg

# Приватный ключ (для расшифровки)

gpg --export-secret-keys --armor blueline > blueline-private.gpg

Шаг 3 — Передать другим разрабам

Передай оба файла безопасным каналом (не email/Slack в открытую — лучше 1Password, Bitwarden, зашифрованный архив).

# Приватный ключ (для расшифровки)

gpg --export-secret-keys --armor blueline > blueline-private.gpg

Шаг 3 — Передать другим разрабам

Передай оба файла безопасным каналом (не email/Slack в открытую — лучше 1Password,
Bitwarden, зашифрованный архив).

Каждый разраб импортирует:

gpg --import blueline-public.gpg
gpg --import blueline-private.gpg

Шаг 4 — Шифрование/расшифровка

# Зашифровать

gpg --encrypt --recipient blueline --armor file.csv

# Расшифровать

gpg --decrypt file.csv.gpg > file.csv

# проверить с каким ключом зашифровано

gpg --list-packets file.csv.gpg
