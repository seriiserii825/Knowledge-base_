### vlc
```
locate youtube.luac
sudo cp ~/Downloads/youtube.luac /usr/lib/x86_64-linux-gnu/vlc/lua/playlist/youtube.luac
```

### youtube-dl

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:deadsnakes/ppa
sudo apt install python3.8
python3 -m pip install -U yt-dlp
```

### yewtube

https://github.com/mps-youtube/yewtube

### [Using pipx (Recommended)](https://github.com/mps-youtube/yewtube#using-pipx-recommended)

1. Install **_pipx_** using `pip install pipx`
2. Install `yewtube` using `pipx install yewtube`
3. Now, type `yt` That's it.

### help

```
 All yewtube commands can be entered from the command line.  For example;

      yt dlurl <url or id> to download a YouTube video by url or id
      yt playurl <url or id> to play a YouTube video by url or id
      yt /mozart to search
      yt //best songs of 2010 for a playlist search
      yt play <playlist name or ID> to play a saved playlist
      yt ls to list saved playlists

    For further automation, a series of commands can be entered separated by
    commas (,).  E.g.,

      yt open 1, 2-4 - play items 2-4 of first saved playlist
      yt //the doors, 1, all -a - open YouTube playlist and play audio

    If you need to enter an actual comma on the command line, use ,, instead.
```
