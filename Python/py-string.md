### умножения строк

```python
print('Hello' * 3)
```

### Оператор принадлежности подстроки

```python
print('lo' in 'Hello')
```

## Встроенные функции строк в python

Python предоставляет множество функций, которые встроены в интерпретатор. Вот несколько, которые работают со строками:

| Функция | Описание                         |
| ------- | -------------------------------- |
| chr()   | Преобразует целое число в символ |
| ord()   | Преобразует символ в целое число |
| len()   | Возвращает длину строки          |
| str()   | Изменяет тип объекта на `string` |

```python
print(ord('a'))
print(chr(97))
print(len('Hello'))
print(str(123))
```

## Срезы строк
```python
s = 'Hello'
print(s[1:4]) # ell
print(s[1:]) # ello
print(s[:4]) # Hell
print(s[:]) # Hello
print(s[1:4:2]) # el
print(s[::2]) # Hlo
print(s[::-1]) # olleH
```

## Встроенные методы строк в python
```python
s = 'Hello'
print(s.upper()) # HELLO
print(s.lower()) # hello
print(s.startswith('He')) # True
print(s.endswith('lo')) # True
print(s.isdigit()) # False
print(s.find('e')) # 1
print(s.replace('l', 'L')) # HeLLo
print(s.split('e')) # ['H', 'llo']
print(' '.join(['Hello', 'world'])) # Hello world
```

## Выравнивание строк, отступы
```python
s = 'Hello'
print(s.center(20, '-')) # -------Hello--------
print(s.ljust(20, '-')) # Hello---------------
print(s.rjust(20, '-')) # ---------------Hello
print('a\tb\tc'.expandtabs()) # a       b       c
```

## Методы преобразование строки в список
```python
s = 'Hello'
print(list(s)) # ['H', 'e', 'l', 'l', 'o']
print(s.split()) # ['Hello']
```
