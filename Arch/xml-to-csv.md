# Xml to csv

```bash
sudo pacman -S gnumeric
ssconvert "CLIENTI-CON-INDIRIZZO.xlsx" "clienti.csv"
column -s, -t < clienti.csv > clienti.txt
libreoffice --headless --convert-to html "clienti.csv"
```
