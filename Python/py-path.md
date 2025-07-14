# Работа с путями в Python

## pathlib Path

```python
from pathlib import Path

path = Path.cwd()
theme_dir_path = path.parts[-1]

print("Где запущен скрипт:", Path.cwd())
print("Где находится файл скрипта:", Path(__file__).resolve().parent)

```

### parent dir path

```python

ROOT_DIR = os.path.dirname(
    os.path.dirname(
        os.path.abspath(__file__)
    )
)
```

### Путь к директории, где находится сам скрипт

```python

script_dir = os.path.dirname(os.path.abspath(__file__))
```

### Путь к рабочей директории (откуда был запущен скрипт)

```python

cwd = os.getcwd()
print("Директория скрипта:", script_dir)
print("Рабочая директория:", cwd)
```

### Разница

```python

os.path.dirname(os.path.abspath(**file**)) — всегда указывает на папку, где лежит сам .py файл.
os.getcwd() — показывает текущую рабочую директорию (может быть другой, если запускали скрипт из другого места).
```

### Применение

Если нужно обращаться к файлам в той же папке, где лежит скрипт:

```python

file_path = os.path.join(script_dir, "data.txt")
```

### Если файлы в рабочей директории

```python

file_path = os.path.join(cwd, "data.txt")
```
