# Xml to csv

```bash
sudo pacman -S gnumeric
ssconvert "CLIENTI-CON-INDIRIZZO.xlsx" "clienti.csv"
column -s, -t < clienti.csv > clienti.txt
ssconvert clienti.csv clienti_raw.html
// to clean html without attributes like style, width, height, etc.
sed -E 's/<(table|tr|td)[^>]*>/\<\1>/g' clienti_raw.html > clienti_clean.html
```
