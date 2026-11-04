# Powerlevel10k

Тема zsh, которая показывает путь, домен git, репозиторий и ветку:

```text
~/dotfiles  github.com/seriiserii825/dotfiles main !4 ?1
❯
```

Раньше стояла тема `amuse`. Домен git она показать не может, потому что не использует remote.

## Как устроено

- Тема лежит в `~/.oh-my-zsh/custom/themes/powerlevel10k`, это отдельный git-клон вне dotfiles.
- Тема включена в `~/dotfiles/zsh_modules/zsh_oh_my_zsh`: `ZSH_THEME="powerlevel10k/powerlevel10k"`.
- Конфиг лежит в `~/dotfiles/.p10k.zsh` (на основе `config/p10k-lean.zsh`), симлинк: `~/.p10k.zsh`.
- Конфиг подключается в конце `.zshrc`: `[[ -f ~/.p10k.zsh ]] && source ~/.p10k.zsh`.
- `.p10k.zsh` убран из `.dotignore`, поэтому `go-dotfiles` его линкует.

## Установка на другой машине

Сначала изменения должны быть запушены в dotfiles.

1. Подтянуть dotfiles:

   ```bash
   cd ~/dotfiles && git pull
   ```

2. Поставить тему:

   ```bash
   git clone --depth=1 https://github.com/romkatv/powerlevel10k.git ~/.oh-my-zsh/custom/themes/powerlevel10k
   ```

   Если папка уже есть, обновить:

   ```bash
   git -C ~/.oh-my-zsh/custom/themes/powerlevel10k pull
   ```

3. Создать симлинк:

   ```bash
   go-dotfiles
   readlink ~/.p10k.zsh   # должно быть /home/serii/dotfiles/.p10k.zsh
   ```

   Если `go-dotfiles` нет или он старый:

   ```bash
   cd ~/Documents/go/go-dotfiles && go install .
   ```

   Либо создать симлинк вручную:

   ```bash
   ln -sfn ~/dotfiles/.p10k.zsh ~/.p10k.zsh
   ```

4. Проверить шрифт:

   ```bash
   fc-list | grep -i 'FiraCode Nerd'
   ```

   Если вывод пустой, иконки будут квадратиками. Поставить шрифт:

   ```bash
   sudo pacman -S ttf-firacode-nerd
   ```

5. Перезапустить shell и проверить:

   ```bash
   exec zsh
   cd ~/dotfiles
   ```

   Затем зайти в репозиторий на Bitbucket или GitLab: там должен быть его домен.

## Как показывается домен

Код добавлен в `my_git_formatter` в `.p10k.zsh`, сразу под строкой `local res`:

```zsh
# Домен и репозиторий из remote: github.com/owner/repo
# У ветки без upstream gitstatus не отдаёт URL, тогда берём origin.
local remote=$VCS_STATUS_REMOTE_URL
[[ -n $remote ]] || remote=$(git -C $VCS_STATUS_WORKDIR config --get remote.origin.url 2>/dev/null)
if [[ -n $remote ]]; then
  remote=${remote#*://}
  remote=${remote#*@}
  remote=${remote%.git}
  remote=${remote/:/\/}
  res+="${meta}${remote//\%/%%} "
fi
```

Чтобы показывать только домен, перед строкой `res+=...` добавить:

```zsh
remote=${remote%%/*}
```

Запасной вариант с `origin` нужен для новых веток до первого `push`: без него домен в них пропадает. Git вызывается
только в этом случае, вызов занимает около 3 мс.

## Что показывает промпт

| Где                    | Что видно                                       |
| ---------------------- | ----------------------------------------------- |
| Репозиторий с remote   | путь, `github.com/владелец/репо`, ветка, статус |
| Ветка без upstream     | то же, домен берётся из `origin`                |
| Репозиторий без remote | путь и ветка                                    |
| Вне git                | только путь                                     |

Индикаторы статуса: `!4` значит 4 изменённых файла, `?1` значит 1 новый файл.

## Если что-то не так

- **Ошибка `theme not found`:** не установлена тема, см. шаг 2.
- **Нет домена и git-статуса:** при первом запуске p10k скачивает `gitstatusd`, и его может блокировать сеть. Проверить:
  `ls ~/.cache/gitstatus`.
- **Откат:** в `zsh_modules/zsh_oh_my_zsh` закомментировать строку с powerlevel10k, раскомментировать `amuse` и
  выполнить `exec zsh`.

## Старая установка

Другой шрифт и клон в домашнюю папку. Сейчас не используется:

```bash
yay -Sy --noconfirm ttf-meslo-nerd-font-powerlevel10k
git clone --depth=1 https://github.com/romkatv/powerlevel10k.git ~/powerlevel10k
```
