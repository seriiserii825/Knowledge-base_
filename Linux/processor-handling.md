## запускаем процесс в фоне
```bash
sleep 10000 &
```

### подключаемся к процессу (jobs работает только внутри одной сессии)
```bash
jobs -l
fg 1(id)
ctrl+z - остановить процесс

bg 1(id) - запустить процесс в фоне
```

## остановить множество процессов сразу одного пользователя
```bash
killall sleep
```

## nohup(запуск процесса в фоне, который не зависит от текущей сессии)
```bash
nohup sleep 10000 &
```

## pstree - показать дерево процессов
```bash
pstree
```

## pgrep and pkill
```bash
pgrep -l sleep
pkill sleep
```

## uptime - показать время работы системы
```bash
uptime
```

## screen - создание новой сессии
```bash
screen -S session_name
ctrl+a d - отключиться от сессии
screen -ls - показать все сессии
screen -r session_name - подключиться к сессии
```