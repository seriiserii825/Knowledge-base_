# install

```bash
sudo pacman -S alsa-lib alsa-plugins alsa-utils pulseaudio-alsa
```

# enable
```bash
sudo systemctl enable alsa-restore
in pavucontrol, set the default output device to the correct one
```

## 2\. Настройка PipeWire[](https://www.baeldung.com/linux/pulseaudio-pipewire-replace#setting-up-pipewire)

Мы можем проверить наличие PipeWire, проверив [статус](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/www.baeldung.com/linux/systemd-create-user-services#the-user-option) службы _pipewire_:

```bash
$ systemctl status --user pipewire
● pipewire.service - PipeWire Multimedia Service
Active: active (running) since Wed 2024-01-17 17:00:52 PKT; 1min 25s ago
...
```

В этом случае PipeWire уже запущен. Следовательно, нам не нужно его устанавливать. Однако, если такой службы нет, то в системе, вероятно, запущен PulseAudio или другой звуковой сервер:

freestar.config.enabled\_slots.push({ placementName: "baeldung\_leaderboard\_mid\_1", slotId: "baeldung\_leaderboard\_mid\_1" });

```bash
$ systemctl status --user pipewire
Unit pipewire.service could not be found.
```

Примечательно, что в системе не установлен PipeWire. В следующих разделах мы удалим PulseAudio, если он существует в системе, и настроим вместо него PipeWire.

### 2.1. Удаление PulseAudio[](https://www.baeldung.com/linux/pulseaudio-pipewire-replace#1-removing-pulseaudio)

**Рекомендуется удалить PulseAudio из системы, чтобы избежать любых конфликтов, которые могут возникнуть.** Однако нам следует предварительно завершить работу демона [_pulseaudio_](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/linux.die.net/man/1/pulseaudio):

```bash
$ pulseaudio --kill
```

Затем мы полностью удаляем пакет _pulseaudio_:

```bash
# Debian and derivatives
$ sudo apt remove --purge pulseaudio

# Fedora and Red Hat
$ sudo dnf remove pulseaudio

# Arch Linux and derivatives
$ sudo pacman -Rns pulseaudio
```

### 2.2. PipeWire[](https://www.baeldung.com/linux/pulseaudio-pipewire-replace#2-pipewire)

PipeWire доступен в большинстве официальных репозиториев пакетов:

```bash
# Debian and derivatives
$ sudo apt install -y pipewire pipewire-audio-client-libraries pulseaudio-utils

# Fedora and Red Hat
$ sudo dnf install -y pipewire pipewire-pulseaudio pipewire-utils pulseaudio-utils

# Arch Linux and derivatives
$ sudo pacman -S --noconfirm pipewire pipewire-pulse
```

**Мы также установили _pipewire-pulse_, который является уровнем совместимости между PipeWire и PulseAudio. Следовательно, если у нас есть приложения, изначально разработанные для работы с PulseAudio, то [_pipewire-pulse_](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/gitlab.freedesktop.org/pipewire/pipewire/-/wikis/Config-PulseAudio) позаботится об этом.** В отличие от этого, мы также можем выбрать уровни совместимости для других аудиосистем.

freestar.config.enabled\_slots.push({ placementName: "baeldung\_leaderboard\_mid\_2", slotId: "baeldung\_leaderboard\_mid\_2" });

Кроме того, _pulseaudio-utils_ включают полезные инструменты, такие как [_pactl_](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/www.baeldung.com/linux/change-default-audio-device-command-line#using-pactl) для управления PulseAudio.

### 2.3. Подключение проводов[](https://www.baeldung.com/linux/pulseaudio-pipewire-replace#3-wireplumber)

**[WirePlumber](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/pipewire.pages.freedesktop.org/wireplumber/) управляет видео и аудиопотоками и [направляет](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/www.baeldung.com/linux/alsa-sound-servers-mute-unmute#2-audio-routing) их по соответствующим каналам. Это также менеджер политик, который принимает решения о том, как обрабатываются видео и аудио.**

Например, когда мы записываем звук в браузере, WirePlumber определяет доступные устройства записи звука, подключенные к системе. Затем он решает, куда направить аудиопоток. В случае отключения микрофона WirePlumber направляет аудиопоток с другого устройства ввода.

Как и PipeWire, WirePlumber доступен в большинстве репозиториев пакетов:

```ruby
# Debian and derivatives
$ sudo apt install -y wireplumber

# Fedora and Red Hat
$ sudo dnf install -y wireplumber

# Arch Linux and derivatives
$ sudo pacman -S --noconfirm wireplumber
```

Как только все необходимые пакеты будут установлены, мы сможем их настроить.

freestar.config.enabled\_slots.push({ placementName: "baeldung\_leaderboard\_mid\_3", slotId: "baeldung\_leaderboard\_mid\_3" });

### 2.4. Конфигурация[](https://www.baeldung.com/linux/pulseaudio-pipewire-replace#4-configuration)

Сначала нам нужно включить необходимые службы:

```bash
systemctl enable --user pipewire
systemctl enable --user wireplumber
```

После включения давайте запустим эти службы:

```bash
systemctl start --user pipewire
systemctl start --user wireplumber
```

Теперь давайте убедимся, что PipeWire работает с использованием _pactl_:

```bash
$ pactl info | grep Server
Server String: /run/user/1000/pulse/native
Server Protocol Version: 35
Server Name: PulseAudio (on PipeWire 0.3.65)
Server Version: 15.0.0
```

Вот и все! Теперь мы можем воспроизводить звуки через PipeWire.

## 3\. Заключение[](https://translated.turbopages.org/proxy_u/en-ru.ru.1ab177c1-667d563b-8db202c9-74722d776562/https/www.baeldung.com/linux/pulseaudio-pipewire-replace#conclusion)

PipeWire - это новый мультимедийный фреймворк, который предназначен для замены PulseAudio и других мультимедийных фреймворков. Некоторые дистрибутивы уже поставляются с установленным по умолчанию PipeWire.

В этом руководстве мы узнали, как заменить PulseAudio на PipeWire. Мы удалили существующую установку PulseAudio и установили соответствующие пакеты для бесперебойной работы PipeWire.
