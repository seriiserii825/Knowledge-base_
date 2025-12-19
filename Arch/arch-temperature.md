### 3️⃣ Температуры (очень важно)

Установи датчики

````bash
sudo pacman -S lm_sensors
sudo sensors-detect
    ```
(везде YES)

Потом:

```bash
sensors
````

Ищи:

```bash
CPU / Core 0/1/...

>70°C — уже шумно

>85°C — вентилятор орёт
```

Можно в реальном времени:

```bash
watch -n 1 sensors
```
