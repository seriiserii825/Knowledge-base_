# Работа с путями в Python

## pathlib Path

```python
from pathlib import Path

path = Path.cwd()
theme_dir_path = path.parts[-1]

print("Где запущен скрипт:", Path.cwd())
print("Где находится файл скрипта:", Path(__file__).resolve().parent)

```

## Путь до скрипта

```python
from pathlib import Path

path = Path.cwd()
print(path)
```

### 🔹 Создание объекта `Path`

```python
p = Path('/home/serii/projects')
print(p.name)         # 'projects'
print(p.parent)       # '/home/serii'
print(p.suffix)       # '' (если файл — будет расширение)
```

---

### 🔹 Проверка существования

```python
if project.exists():
    print("Файл существует")

if project.is_file():
    print("Это файл")

if project.is_dir():
    print("Это директория")
```

---

### 🔹 Чтение и запись

```python
# Прочитать файл
text = Path('notes.txt').read_text(encoding='utf-8')

# Записать файл
Path('notes.txt').write_text("Привет!", encoding='utf-8')
```

---

### 🔹 Обход директории

```python
for file in Path('src').iterdir():
    print(file)

# Рекурсивно
for py in Path('src').rglob('*.py'):
    print(py)
```

---

### 🔹 Создание директорий

```python
Path('new_folder').mkdir(exist_ok=True)
Path('parent/child').mkdir(parents=True, exist_ok=True)
```

### Создание файла

```python
Path('new_file.txt').touch(exist_ok=True)
```

---

### 🔹 Удаление файлов

```python
Path('file.txt').unlink()
```

---

### 🔹 Получение абсолютного пути

```python
p = Path('somefile.txt')
print(p.resolve())  # Абсолютный путь
```

---

### 🔹 Примеры использования

```python
# Получить все файлы .txt в текущей папке
txt_files = list(Path('.').glob('*.txt'))

# Удалить все пустые .log файлы
for log in Path('.').rglob('*.log'):
    if log.stat().st_size == 0:
        log.unlink()
```
