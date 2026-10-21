# GitHub Release

Release — функция **GitHub**, не git. Страница на сайте, привязанная к тегу:
заголовок, описание, при желании файлы (бинарники, архивы). В `git clone` не
попадает — существует только на github.com. Теги — см. `git-tag.md`.

## Тег vs Release

| | Тег | Release |
|---|---|---|
| Где живёт | в git-репозитории | только на GitHub |
| Создаётся | `git tag -a v0.9.0 -m "..."` | `gh release create v0.9.0` / сайт |
| Без другого | может быть без release | не бывает без тега |
| Нужен Go / `git clone --branch` | **да** | нет |
| Где видно описание | `git tag -n`, `git show` | вкладка Releases, главная репо |

Удалишь все Releases — ничего не сломается. Удалишь тег — `go get …@v0.9.0` и
`git checkout v0.9.0` перестанут работать.

## Когда делать

- Не обязательно — для Go хватает тегов.
- Полезно, когда нужно **видимое** описание версии на GitHub: на вкладке Tags
  аннотация тега почти не видна.
- Для библиотеки (go-libs) полезнее, чем для программы: перед обновлением
  (`go-update-libs.sh`) видно, что изменилось между версиями.
- Нужно, если прикладываешь готовые бинарники для скачивания.

## Создать

Тег должен быть запушен (или `gh` создаст его сам на текущем коммите ветки
по умолчанию). Для уже существующего тега — перетегировать **не нужно**.

```
gh release create v0.1.3 --notes-from-tag               # описание = аннотация тега
gh release create v0.1.3 --generate-notes               # из коммитов с прошлого тега
gh release create v0.1.3 --title "v0.1.3" --notes "color-shade: short hex"
gh release create v0.1.3 --notes-file CHANGELOG.md
gh release create v0.1.3 ./go-scripts ./fzf-word-filter # + бинарники
```

- `--notes-from-tag` — удобно с аннотированными тегами (py-sync-settings
  `lft --push-tag` их уже делает): описание пишется один раз, в теге.
- `--draft` — черновик, `--prerelease` — пометить как пре-релиз.

Через сайт: Releases → Draft a new release → выбрать существующий тег.

`gh` должен быть авторизован: `gh auth status`, если нет — `gh auth login`.

## Посмотреть / изменить / удалить

```
gh release list
gh release view v0.1.3
gh release edit v0.1.3 --notes "новое описание"
gh release delete v0.1.3            # тег остаётся
gh release delete v0.1.3 --cleanup-tag   # удалить и тег (для Go — не надо)
```
