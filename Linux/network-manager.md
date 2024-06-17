```
 sudo systemctl start NetworkManager

Теперь смотрим состояние интерфейсов с помощью nmcli:

nmcli general status
```

###

```
nmcli connection show
nmcli radio wifi
```

Теперь включаем:

`nmcli radio wifi on`

Или отключаем:

`nmcli radio wifi off`

Такой командой можно посмотреть список доступных сетей wifi:

`nmcli device wifi list`

Команда для подключения к новой сети wifi выглядит не намного сложнее. Например, давайте подключимся к сети TP-Link с паролем 12345678:

`nmcli device wifi connect "TP-Link" password 12345678 name "TP-Link Wifi"`
