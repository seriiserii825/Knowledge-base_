# local addon search project

Расширение для LocalWP, позволяющее искать среди проектов.

https://github.com/seriiserii825/local-addon-search-project

## install with node and make build

Готовых релизов на GitHub может не быть (release публикуется только через CI по git-тегу).
В этом случае собрать вручную:

```bash
bun install && bun run build
```

Затем запаковать в tar.gz как это делает их CI (`.github/workflows/release.yml`):

```bash
tar -czf local-addon-search-project_<version>.tar.gz *
```

## установка

Go to releases on the side and choose the latest release. Download the release file (not source code).
Go to your localWP and choose addons->Installed tab and click on the "Install from disk" button.
Choose the zip.gz file and install it.
Enable addon and restart local.

## ошибка EXDEV: cross-device link not permitted

Если `/tmp` смонтирован как отдельная файловая система (tmpfs), а `~/.config/Local`
находится на другом разделе — Local падает с ошибкой `EXDEV` при установке аддона
(он распаковывает архив в `/tmp`, а потом пытается `rename` в `~/.config/Local/addons`,
что невозможно между разными ФС).

Проверить:

```bash
df -hT /tmp /home
```

Фикс — запустить Local с `TMPDIR`, указывающим на директорию внутри `$HOME` (тот же диск):

```bash
mkdir -p ~/.cache/local-tmp
TMPDIR=~/.cache/local-tmp /opt/Local/Local
```

После этого повторить "Install from disk".

⚠️ Этот запуск с `TMPDIR` — только для одной установки аддона. После установки
**закрыть Local и запустить его заново обычным способом** (через ярлык/лончер,
не из той же терминальной сессии). Иначе роутер (nginx) может не стартовать с
ошибкой `bind() to 0.0.0.0:80 failed (13: Permission denied)` — если терминал,
из которого запущен Local, имеет флаг `no_new_privs`, ядро игнорирует файловую
capability `cap_net_bind_service` у nginx-бинарника Local
(`~/.config/Local/lightning-services/nginx-*/bin/linux/sbin/nginx`), и nginx
не может забиндиться на привилегированный порт 80, хотя сама capability
на диске цела (проверяется `getcap`). Лечится обычным перезапуском Local
не из "песочной"/ограниченной оболочки.
