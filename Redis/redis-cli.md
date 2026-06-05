Полезные команды внутри:

# Все ключи сессий

KEYS sessions:\*

# Посмотреть конкретную сессию (JSON)

GET sessions:<id>

# Сколько секунд до истечения

TTL sessions:<id>

# Удалить сессию (принудительный logout)

DEL sessions:<id>

# Удалить все сессии сразу

DEL sessions:\* # не работает напрямую

# вместо этого:

KEYS sessions:\* → потом DEL sessions:abc sessions:def ...

# Количество всех ключей в базе

DBSIZE

# Мониторинг в реальном времени (видишь все команды)

MONITOR

# Выйти

EXIT
