# Создайте список
z = [3, 7, 4, 2]
# Вывод элементов с индексом от 0 до 2 (не включая 2)
print(z[0:2]) 
# вывод: [3, 7]

# Все, кроме индекса 3
>>> print(z[:3])
[3, 7, 4]

# Создайте список
>>> z = [4, 1, 5, 4, 10, 4]
>>> print(z.index(4))
0

## Проход (итерация) по списку

Читать элементы списка можно с помощью следующего цикла:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
for elem in my_list:
    print(elem)
```

Таким образом можно читать элементы списка. А вот что касается их обновления:

```py
my_list = [1, 2, 3, 4, 5]
for i in range(len(my_list)):
    my_list[i]+=5
    print(my_list)
```

Результат будет следующим:

```
[6, 7, 8, 9, 10]
```

## Вставить в список

Метод `insert` можно использовать, чтобы вставить элемент в список:

```py
my_list = [1, 2, 3, 4, 5]
my_list.insert(1,'Привет')
print(my_list)
```

Результат:

```
[1, 'Привет', 2, 3, 4, 5]
```

## Добавить в список

Метод `append` можно использовать для добавления элемента в список:

  

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
my_list.append('ещё один')
print(my_list)
```

Результат:

```
['один', 'два', 'три', 'четыре', 'пять', 'ещё один']
```

Можно добавить и больше одного элемента таким способом:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
list_2  =  ['шесть',  'семь']
my_list.extend(list_2)
print(my_list)
```

Результат:

```
['один', 'два', 'три', 'четыре', 'пять', 'шесть',  'семь']
```

При этом `list_2` не поменяется.

## Отсортировать список

Для сортировки списка нужно использовать метод `sort`.

```py
my_list = ['cde', 'fgh', 'abc', 'klm', 'opq']
list_2 = [3, 5, 2, 4, 1]
my_list.sort()
list_2.sort()
print(my_list)
print(list_2)
```

Вывод:

```
['abc', 'cde', 'fgh', 'klm', 'opq']
[1, 2, 3, 4, 5]
```

## Перевернуть список

Можно развернуть порядок элементов в списке с помощью метода `reverse`:

```py
my_list = [1, 2, 3, 4, 5]
my_list.reverse()
print(my_list)
```

Результат:

```
[5, 4, 3, 2, 1]
```

## Индекс элемента

Метод `index` можно использовать для получения индекса элемента:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
print(my_list.index('два'))
```

Результат `1`.

Если в списке больше одного такого же элемента, [функция вернет](https://pythonru.com/osnovy/funkcii-v-python) индекс первого.

## Удалить элемент

Удалить элемент можно, написав его индекс в методе `pop`:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
removed = my_list.pop(2)
print(my_list)
print(removed)
```

Результат:

```
['один', 'два', 'четыре', 'пять']
три
```

Если не указывать индекс, то функция удалит последний элемент.

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
removed = my_list.pop()
print(my_list)
print(removed)
```

Результат:

```
['один', 'два', 'три', 'четыре']
пять
```

Элемент можно удалить с помощью метода `remove`.

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
my_list.remove('два')
print(my_list)
```

Результат:

  

```
['один', 'три', 'четыре', 'пять']
```

Оператор `del` можно использовать для тех же целей:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
del my_list[2]
print(my_list)
```

Результат:

```
['один', 'два', 'четыре', 'пять']
```

Можно удалить несколько элементов с помощью оператора среза:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
del my_list[1:3]
print(my_list)
```

Результат:

```
['один', 'четыре', 'пять']
```

## Функции агрегации

В Python есть некоторые агрегатные функции:

```py
my_list = [5, 3, 2, 4, 1]
print(len(my_list))
print(min(my_list))
print(max(my_list))
print(sum(my_list))
```

`sum()` работает только с числовыми значениями.

А `max()`, `len()` и другие можно использовать и со строками.

## Сравнить списки

В Python 2 сравнить элементы двух списком можно с помощью функции `cmp`:

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
list_2 = ['три', 'один', 'пять', 'два', 'четыре']
print(cmp(my_list,list_2))
```

Она вернет `-1`, если списки не совпадают, и `1` в противном случае.

В Python 3 для этого используется оператор (`==`):

```py
my_list = ['один', 'два', 'три', 'четыре', 'пять']
list_2 = ['три', 'один', 'пять', 'два', 'четыре']
if (my_list == list_2):
    print('cовпадают')
else:
    print('не совпадают')
```

Результат `не совпадают`.

## Математические операции на списках:

Для объединения списков можно использовать [оператор](https://pythonru.com/uroki/operatory-v-python-uroki-po-python-dlja-nachinajushhih) (`+`):

```py
list_1 = [1, 2, 3]
list_2 = [4, 5, 6]
print(list_1 + list_2)
```

Результат:

```
[1, 2, 3, 4, 5, 6]
```

Список можно повторить с помощью оператора умножения:

```py
list_1 = [1, 2, 3]
print(list_1  *  2)
```

Результат:

```
[1, 2, 3, 1, 2, 3]
```

