# pass: конфликт в git с зашифрованными файлами

`pass git push/pull` = `cd ~/.password-store && git push/pull`.

Файлы `.gpg` для git — бинарные, автоматически слить их нельзя. Конфликт бывает только если **один и тот же** пароль изменили на двух машинах без синхронизации. Разные пароли = разные файлы → git сливает сам.

## Разрешить

```bash
cd ~/.password-store
git status                          # both modified: ssh/vps.gpg
```

Сравнить версии:

```bash
git show :2:ssh/vps.gpg | gpg -d    # своя (локальная)
git show :3:ssh/vps.gpg | gpg -d    # с GitHub
```

Выбрать одну:

```bash
git checkout --ours   ssh/vps.gpg   # оставить свою
git checkout --theirs ssh/vps.gpg   # взять с GitHub

git add ssh/vps.gpg
git commit
git push
```

Нужно из обеих → взять одну, потом `pass edit ssh/vps`, дописать руками, закоммитить.

## git diff с расшифровкой (один раз)

```bash
cd ~/.password-store
echo '*.gpg diff=gpg' >> .gitattributes
git config diff.gpg.binary true
git config diff.gpg.textconv "gpg -d --quiet --yes --compress-algo=none --no-encrypt-to --batch --use-agent"
```

Теперь `git diff` / `git log -p` показывают пароли текстом (только локально, в репо ничего не попадает).

## Не допускать

Сел за компьютер → `pass git pull`. Изменил → `pass git push`.
