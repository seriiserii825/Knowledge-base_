# Отдельный SSH-ключ для второго аккаунта (Gitea bludelego) на сервере

Git-сервер определяет аккаунт по SSH-ключу. Для второго аккаунта нужен отдельный ключ, привязанный к хосту в
`~/.ssh/config`. Без `ssh-agent`/`ssh-add`: `~/.ssh/config` сам выбирает нужный ключ, и настройка сохраняется после
выхода с сервера.

Аккаунт `webmaster@bludelego.it` — это свой Gitea/Forgejo на `git.bludelego.com`, **не github.com**.

## 1. Сгенерировать ключ

Имя файла задаётся через `-f`, поэтому ssh-keygen его не спросит и не перезапишет существующий `id_ed25519`.

```bash
ssh-keygen -t ed25519 -C "webmaster@bludelego.it" -f ~/.ssh/id_ed25519_forgeo
```

## 2. Прописать хосты в `~/.ssh/config`

```bash
cat >> ~/.ssh/config <<'EOF'
# GitHub (существующий ключ)
Host github.com
    HostName github.com
    User git
    IdentityFile ~/.ssh/id_ed25519
    IdentitiesOnly yes

# Gitea bludelego (webmaster@bludelego.it)
Host git.bludelego.com
    HostName git.bludelego.com
    User git
    IdentityFile ~/.ssh/id_ed25519_forgeo
    IdentitiesOnly yes
EOF
chmod 600 ~/.ssh/config
```

`IdentitiesOnly yes` запрещает ssh пробовать другие ключи, поэтому аккаунты не перепутаются. Если SSH на сервере на
нестандартном порту — добавить `Port <номер>` в блок хоста.

## 3. Добавить публичный ключ в аккаунт

```bash
cat ~/.ssh/id_ed25519_forgeo.pub
```

`https://git.bludelego.com` → войти под `webmaster@bludelego.it` → Settings → SSH / GPG Keys → Add key, вставить вывод
команды.

Сверить отпечаток с тем, что показывает веб-интерфейс:

```bash
ssh-keygen -lf ~/.ssh/id_ed25519_forgeo.pub
```

## 4. Проверить

```bash
ssh -T git@git.bludelego.com     # Hi there, <user>! You've successfully authenticated...
```

`Permission denied (publickey)` у `ssh -T git@github.com` значит, что `id_ed25519` не добавлен ни в один GitHub-аккаунт
— к Gitea это отношения не имеет.

## 5. Клонировать

URL берётся как есть со страницы репозитория:

```bash
git clone ssh://git@git.bludelego.com/bludelego/bs-iteco.git
cd bs-iteco
git config user.email "webmaster@bludelego.it"
git config user.name "<Name>"
```

## 6. Сменить remote у уже склонированного репозитория

Например, если репозиторий был склонирован по HTTPS или с другого хоста:

```bash
git remote -v                                                              # посмотреть текущий
git remote set-url origin ssh://git@git.bludelego.com/bludelego/bs-iteco.git
git remote -v                                                              # проверить
git fetch                                                                  # проверить доступ
```

Если remote `origin` ещё нет (например, после `git init`):

```bash
git remote add origin ssh://git@git.bludelego.com/bludelego/bs-iteco.git
git push -u origin main
```
