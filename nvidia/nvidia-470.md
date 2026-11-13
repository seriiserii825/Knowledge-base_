# NVIDIA 470xx на старой карте — как жить и сколько осталось

Установка драйвера (пошагово): [[arch-nvidia-470]] (`Arch/arch-nvidia-470.md`).
Переход на LTS-ядро и systemd-boot: `Arch/arch-linux-lts.txt`.

## Железо и текущая связка (на 2026-11-13)

- Видеокарта: **GeForce GTX 650** (Kepler, GK107, `10de:0fc6`).
- Драйвер: `nvidia-470xx-dkms` / `nvidia-470xx-utils` 470.256.02 (AUR).
- Ядро: **`linux-lts` 6.18.58** — загружается по умолчанию (`/boot/loader/loader.conf` → `default linux-lts.conf`).
- Также установлено обычное ядро `linux` (7.2.x) — **под ним nvidia-470xx не собирается** (`dkms install ... exited 10`), графики там нет.

470 — последняя ветка драйвера для Kepler. NVIDIA её больше не развивает, в AUR она живёт на патчах сообщества. Под ядра 7.x сборка ломается не только у нас: Fedora (7.0.4, https://bugzilla.redhat.com/show_bug.cgi?id=2468540), CachyOS (7.2, https://discuss.cachyos.org/t/kernel-7-2-0-1-cachyos-breaks-nvidia-470xx-dkms/34636).

## Почему `linux-lts` в IgnorePkg

`/etc/pacman.conf`:
```
IgnorePkg = cmake flameshot linux-lts linux-lts-headers
```

Если `linux-lts` обновится бездумно:
1. dkms попробует собрать nvidia-470xx под новое ядро. Если сборка упадёт, после ребута lts-ядро запустится **без модуля nvidia**: Xorg не стартует, чёрный экран или только TTY. Запасного ядра с графикой нет: `linux` 7.x тоже без nvidia.
2. Даже если сборка прошла, до перезагрузки модули старого ядра уже удалены из `/usr/lib/modules`. Новые устройства (USB и т.п.) не подхватятся, пока не перезагрузишься.

(Почему в IgnorePkg `cmake` и `flameshot`, здесь не записано: вероятно, из-за регрессий в их новых версиях.)

## Как безопасно обновить linux-lts (вручную, когда решишь)

```bash
sudo pacman -S linux-lts linux-lts-headers     # явная установка обходит IgnorePkg
dkms status                                    # nvidia/470.256.02, <новая версия>-lts: installed
ls /usr/lib/modules/                           # есть каталог новой версии
```
Перезагружаться только если dkms показал `installed` для новой версии.
Если сборка упала, откатить ядро из кэша **до ребута**:
```bash
ls /var/cache/pacman/pkg/linux-lts-*
sudo pacman -U /var/cache/pacman/pkg/linux-lts-<старая>.pkg.tar.zst /var/cache/pacman/pkg/linux-lts-headers-<старая>.pkg.tar.zst
```

## Проверка после обычного `pacman -Syu` («не полетит ли после ребута»)

```bash
uname -r                                  # запущенное ядро
pacman -Q linux-lts nvidia-470xx-utils    # установленные версии
dkms status                               # модуль собран под lts → installed
cat /proc/driver/nvidia/version           # версия загруженного модуля = версии utils
grep -E 'dkms|WARNING|ERROR' /var/log/pacman.log | tail -20
```
`dkms ... exited 10` для ядра `linux` 7.x — ожидаемо, не страшно, если загрузка идёт с lts.
**В меню systemd-boot не выбирать пункт без lts** — там нет графики. Попал туда → перезагрузиться в lts.

## Сколько ещё можно так жить

- 6.18 LTS поддерживается kernel.org **примерно до декабря 2028** (продлено с декабря 2027; это прогноз, не гарантия).
  https://phoronix.com/news/linux-6.18-lts-6.12-6.6-extend
- Пока сидим на 6.18 и драйвер собирается, реальный горизонт — **конец 2028**.

Что может сломать раньше:
- **Обновление `xorg-server` с новым ABI видеодрайверов**: проприетарный 470 может перестать грузиться. Следить при обновлениях Xorg (сейчас 21.1.x работает).
- Патч-релиз внутри 6.18, ломающий сборку dkms (редко, но бывает).
- Arch может перевести пакет `linux-lts` на следующую LTS-ветку (не 6.18). Защищает IgnorePkg.
- Драйвер не получает исправлений безопасности. Для десктопа это небольшой риск.

## nouveau — не вариант

На этой машине с nouveau **всё фризит** (проверено). Типично для Kepler: без проприетарного драйвера карта сидит на минимальных частотах, плюс проблемы с ускорением. Можно было бы крутить (ручной reclock через `/sys/kernel/debug/dri/0/pstate`, `modesetting` вместо `xf86-video-nouveau`, picom на `xrender`/без композитора), но гарантий нет — решили не тратить время. См. также `Arch/arch-nouveau.md`.

## План

1. Сейчас: `nvidia-470xx` + `linux-lts` 6.18, `linux-lts` в IgnorePkg.
2. lts обновлять только вручную по шагам выше.
3. Заранее заложить замену видеокарты. Лучше **AMD** (RX 6400/6500, б/у RX 570/580): драйвер в ядре, без dkms, работает с любым ядром. Или NVIDIA Turing+ с `nvidia-open`. Когда 470 окончательно отвалится, ставим карту — и всё.
4. Обычное ядро `linux` можно оставить как аварийное: графики нет, но в TTY для починки загрузиться можно. Или удалить, чтобы dkms не ругался при каждом обновлении.
