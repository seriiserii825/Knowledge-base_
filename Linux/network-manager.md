 sudo systemctl start NetworkManager
 sudo systemctl status NetworkManager
 sudo systemctl enable NetworkManager
Теперь смотрим состояние интерфейсов с помощью nmcli:
nmcli radio wifi
Теперь включаем:
nmcli radio wifi on
nmcli con show
Такой командой можно посмотреть список доступных сетей wifi:
nmcli device wifi list
Команда для подключения к новой сети wifi выглядит не намного сложнее. Например, давайте подключимся к сети TP-Link с паролем 12345678:
nmcli device wifi connect "TP-Link" password 12345678 name "TP-Link Wifi"
nmcli --ask dev wifi connect XYZ (where XYZ is the name of the SSID)
