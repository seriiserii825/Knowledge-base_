1. Встроенная фильтрация gita:
bash# Показать только репозитории с изменениями (uncommitted files)
gita ll -C

# Показать только dirty репозитории (с незакоммиченными изменениями)
gita ll | grep '\$'

# Показать только репозитории требующие push
gita ll | grep '↑'

# Показать только репозитории требующие pull  
gita ll | grep '↓'
2. Более точная фильтрация:
bash# Только с локальными изменениями (значок $)
gita ll -C | grep '\$'

# Только требующие push (стрелка вверх)
gita ll -C | grep '↑'

# Только требующие pull (стрелка вниз)
gita ll -C | grep '↓'
3. Если нужно видеть только конкретные типы изменений:
bash# Создайте alias в ~/.bashrc или ~/.zshrc
alias gita-push='gita ll -C | grep "↑"'
alias gita-pull='gita ll -C | grep "↓"'
alias gita-dirty='gita ll -C | grep "\$"'
Из вашего вывода видно, что bs-fcep-- имеет стрелку [↑] - это значит нужен push. Команда gita ll -C | grep '↑' должна показать только такие репозитории.
