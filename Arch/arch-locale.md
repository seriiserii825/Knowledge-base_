в файле

```
/etc/locale.gen
ru_RU.UTF-8 UTF-8 для рашн
```

сохраняешь и запускаешь команду

```
sudo locale-gen
```

проверяешь

```

localectl list-locales
```

прописываешь такую строку

```
/etc/locale.conf
LANG=en_US.UTF-8
localectl status
```

или

```
locale
```
