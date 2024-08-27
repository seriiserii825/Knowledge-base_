| S.No | Method | Description | Example |
| --- | --- | --- | --- |
| 1 | [append()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#append) | Adds an element at the end of the list | `list.append(element)``list.append(element)` |
| 2 | [clear()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#clear) | Removes all the elements from the list | `list.clear()``list.clear()` |
| 3 | [copy()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#copy) | Returns a copy of the list | `list.copy()``list.copy()` |
| 4 | [count()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#count) | Returns the number of elements with the specified value | `list.count(value)``list.count(value)` |
| 5 | [extend()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#extend) | Add the elements of a list (or any iterable), to the end of the current list | `list.extend(iterable)``list.extend(iterable)` |
| 6 | [index()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#index) | Returns the index of the first element with the specified value | `list.index(value)``list.index(value)` |
| 7 | [insert()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#insert) | Adds an element at the specified position | `list.insert(position, element)``list.insert(position, element)` |
| 8 | [pop()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#pop) | Removes the element at the specified position | `list.pop(position)``list.pop(position)` |
| 9 | [remove()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#remove) | Removes the first item with the specified value | `list.remove(value)``list.remove(value)` |
| 10 | [reverse()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#reverse) | Reverses the order of the list | `list.reverse()``list.reverse()` |
| 11 | [sort()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#sort) | Sorts the list | `list.sort()``list.sort()` |
| 12 | [len()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#len) | Returns the length of the list | `len(list)``len(list)` |
| 13 | [max()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#max) | Returns the largest item in the list | `max(list)``max(list)` |
| 14 | [min()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#min) | Returns the smallest item in the list | `min(list)``min(list)` |
| 15 | [sum()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#sum) | Returns the sum of all items in the list | `sum(list)``sum(list)` |
| 16 | [all()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#all) | Returns True if all items in the list are true | `all(list)``all(list)` |
| 17 | [any()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#any) | Returns True if any item in the list is true | `any(list)``any(list)` |
| 18 | [enumerate()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#enumerate) | Returns an enumerate object. It contains the index and value of all the items in the list | `enumerate(list)``enumerate(list)` |
| 19 | [filter()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#filter) | Use a filter function to exclude items in an iterable object | `filter(function, iterable)``filter(function, iterable)` |
| 20 | [map()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#map) | Use a map function to execute a specified function for each item in an iterable. The item is sent to the function as a parameter | `map(function, iterable)``map(function, iterable)` |
| 21 | [reversed()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#reversed) | Returns a reversed iterator | `reversed(list)``reversed(list)` |
| 22 | [sorted()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#sorted) | Returns a sorted list | `sorted(list)``sorted(list)` |
| 23 | [zip()](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#zip) | Returns an iterator, from two or more iterators | `zip(iterator1, iterator2, iterator3, ...)``zip(iterator1, iterator2, iterator3, ...)` |
| 24 | [del](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#del) | Removes the specified index | `del list[index]``del list[index]` |
| 25 | [in](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#in) | Returns True if a sequence with the specified value is present in the list | `element in list``element in list` |
| 26 | [not in](https://python-central-hub.vercel.app/tutorials/python-list/list-methods/#not-in) | Returns True if a sequence with the specified value is not present in the list | `element not in list``element not in list` |

## append()

The `append()``append()` method adds an element at the end of the list. The syntax of the `append()``append()` method is: `list.append(element)``list.append(element)`. Here is an example:

append.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.append("orange")
print(fruits)
```

append.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.append("orange")
print(fruits)
```

Output:

command

```
C:\Users\username>python append.py
['apple', 'banana', 'cherry', 'orange']
```

command

```
C:\Users\username>python append.py
['apple', 'banana', 'cherry', 'orange']
```

## clear()

The `clear()``clear()` method removes all the elements from the list. The syntax of the `clear()``clear()` method is: `list.clear()``list.clear()`. Here is an example:

clear.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.clear()
print(fruits)
```

clear.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.clear()
print(fruits)
```

Output:

command

```
C:\Users\username>python clear.py
[]
```

command

```
C:\Users\username>python clear.py
[]
```

## copy()

The `copy()``copy()` method returns a copy of the list. The syntax of the `copy()``copy()` method is: `list.copy()``list.copy()`. Here is an example:

copy.py

```
fruits = ['apple', 'banana', 'cherry']
fruits_copy = fruits.copy()
print(fruits_copy)
```

copy.py

```
fruits = ['apple', 'banana', 'cherry']
fruits_copy = fruits.copy()
print(fruits_copy)
```

Output:

command

```
C:\Users\username>python copy.py
['apple', 'banana', 'cherry']
```

command

```
C:\Users\username>python copy.py
['apple', 'banana', 'cherry']
```

## count()

The `count()``count()` method returns the number of elements with the specified value. The syntax of the `count()``count()` method is: `list.count(value)``list.count(value)`. Here is an example:

count.py

```
fruits = ['apple', 'banana', 'cherry', 'banana']
count = fruits.count("banana")
print(count)
```

count.py

```
fruits = ['apple', 'banana', 'cherry', 'banana']
count = fruits.count("banana")
print(count)
```

Output:

command

```
C:\Users\username>python count.py
2
```

command

```
C:\Users\username>python count.py
2
```

## extend()

The `extend()``extend()` method adds the elements of a list (or any iterable), to the end of the current list. The syntax of the `extend()``extend()` method is: `list.extend(iterable)``list.extend(iterable)`. Here is an example:

extend.py

```
fruits = ['apple', 'banana', 'cherry']
more_fruits = ['orange', 'mango', 'grapes']
fruits.extend(more_fruits)
print(fruits)
```

extend.py

```
fruits = ['apple', 'banana', 'cherry']
more_fruits = ['orange', 'mango', 'grapes']
fruits.extend(more_fruits)
print(fruits)
```

Output:

command

```
C:\Users\username>python extend.py
['apple', 'banana', 'cherry', 'orange', 'mango', 'grapes']
```

command

```
C:\Users\username>python extend.py
['apple', 'banana', 'cherry', 'orange', 'mango', 'grapes']
```

## index()

The `index()``index()` method returns the index of the first element with the specified value. The syntax of the `index()``index()` method is: `list.index(value)``list.index(value)`. Here is an example:

index.py

```
fruits = ['apple', 'banana', 'cherry']
index = fruits.index("banana")
print(index)
```

index.py

```
fruits = ['apple', 'banana', 'cherry']
index = fruits.index("banana")
print(index)
```

Output:

command

```
C:\Users\username>python index.py
1
```

command

```
C:\Users\username>python index.py
1
```

## insert()

The `insert()``insert()` method adds an element at the specified position. The syntax of the `insert()``insert()` method is: `list.insert(position, element)``list.insert(position, element)`. Here is an example:

insert.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.insert(1, "orange")
print(fruits)
```

insert.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.insert(1, "orange")
print(fruits)
```

Output:

command

```
C:\Users\username>python insert.py
['apple', 'orange', 'banana', 'cherry']
```

command

```
C:\Users\username>python insert.py
['apple', 'orange', 'banana', 'cherry']
```

## pop()

The `pop()``pop()` method removes the element at the specified position. The syntax of the `pop()``pop()` method is: `list.pop(position)``list.pop(position)`. Here is an example:

pop.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.pop(1)
print(fruits)
```

pop.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.pop(1)
print(fruits)
```

Output:

command

```
C:\Users\username>python pop.py
['apple', 'cherry']
```

command

```
C:\Users\username>python pop.py
['apple', 'cherry']
```

## remove()

The `remove()``remove()` method removes the first item with the specified value. The syntax of the `remove()``remove()` method is: `list.remove(value)``list.remove(value)`. Here is an example:

remove.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.remove("banana")
print(fruits)
```

remove.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.remove("banana")
print(fruits)
```

Output:

command

```
C:\Users\username>python remove.py
['apple', 'cherry']
```

command

```
C:\Users\username>python remove.py
['apple', 'cherry']
```

## reverse()

The `reverse()``reverse()` method reverses the order of the list. The syntax of the `reverse()``reverse()` method is: `list.reverse()``list.reverse()`. Here is an example:

reverse.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.reverse()
print(fruits)
```

reverse.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.reverse()
print(fruits)
```

Output:

command

```
C:\Users\username>python reverse.py
['cherry', 'banana', 'apple']
```

command

```
C:\Users\username>python reverse.py
['cherry', 'banana', 'apple']
```

## sort()

The `sort()``sort()` method sorts the list. The syntax of the `sort()``sort()` method is: `list.sort()``list.sort()`. Here is an example:

sort.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.sort()
print(fruits)
```

sort.py

```
fruits = ['apple', 'banana', 'cherry']
fruits.sort()
print(fruits)
```

Output:

command

```
C:\Users\username>python sort.py
['apple', 'banana', 'cherry']
```

command

```
C:\Users\username>python sort.py
['apple', 'banana', 'cherry']
```

## len()

The `len()``len()` method returns the length of the list. The syntax of the `len()``len()` method is: `len(list)``len(list)`. Here is an example:

len.py

```
fruits = ['apple', 'banana', 'cherry']
length = len(fruits)
print(length)
```

len.py

```
fruits = ['apple', 'banana', 'cherry']
length = len(fruits)
print(length)
```

Output:

command

```
C:\Users\username>python len.py
3
```

command

```
C:\Users\username>python len.py
3
```

## max()

The `max()``max()` method returns the largest item in the list. The syntax of the `max()``max()` method is: `max(list)``max(list)`. Here is an example:

max.py

```
numbers = [1, 2, 3, 4, 5]
max_number = max(numbers)
print(max_number)
```

max.py

```
numbers = [1, 2, 3, 4, 5]
max_number = max(numbers)
print(max_number)
```

Output:

command

```
C:\Users\username>python max.py
5
```

command

```
C:\Users\username>python max.py
5
```

## min()

The `min()``min()` method returns the smallest item in the list. The syntax of the `min()``min()` method is: `min(list)``min(list)`. Here is an example:

min.py

```
numbers = [1, 2, 3, 4, 5]
min_number = min(numbers)
print(min_number)
```

min.py

```
numbers = [1, 2, 3, 4, 5]
min_number = min(numbers)
print(min_number)
```

Output:

command

```
C:\Users\username>python min.py
1
```

command

```
C:\Users\username>python min.py
1
```

## sum()

The `sum()``sum()` method returns the sum of all items in the list. The syntax of the `sum()``sum()` method is: `sum(list)``sum(list)`. Here is an example:

sum.py

```
numbers = [1, 2, 3, 4, 5]
sum_numbers = sum(numbers)
print(sum_numbers)
```

sum.py

```
numbers = [1, 2, 3, 4, 5]
sum_numbers = sum(numbers)
print(sum_numbers)
```

Output:

command

```
C:\Users\username>python sum.py
15
```

command

```
C:\Users\username>python sum.py
15
```

## all()

The `all()``all()` method returns True if all items in the list are true. The syntax of the `all()``all()` method is: `all(list)``all(list)`. Here is an example:

all.py

```
numbers = [1, 2, 3, 4, 5]
all_numbers = all(numbers)
print(all_numbers)
```

all.py

```
numbers = [1, 2, 3, 4, 5]
all_numbers = all(numbers)
print(all_numbers)
```

Output:

command

```
C:\Users\username>python all.py
True
```

command

```
C:\Users\username>python all.py
True
```

## any()

The `any()``any()` method returns True if any item in the list is true. The syntax of the `any()``any()` method is: `any(list)``any(list)`. Here is an example:

any.py

```
numbers = [1, 2, 3, 4, 5]
any_numbers = any(numbers)
print(any_numbers)
```

any.py

```
numbers = [1, 2, 3, 4, 5]
any_numbers = any(numbers)
print(any_numbers)
```

Output:

command

```
C:\Users\username>python any.py
True
```

command

```
C:\Users\username>python any.py
True
```

## enumerate()

The `enumerate()``enumerate()` method returns an enumerate object. It contains the index and value of all the items in the list. The syntax of the `enumerate()``enumerate()` method is: `enumerate(list)``enumerate(list)`. Here is an example:

enumerate.py

```
numbers = [1, 2, 3, 4, 5]
enumerate_numbers = enumerate(numbers)
print(enumerate_numbers)
print(list(enumerate_numbers))
```

enumerate.py

```
numbers = [1, 2, 3, 4, 5]
enumerate_numbers = enumerate(numbers)
print(enumerate_numbers)
print(list(enumerate_numbers))
```

Output:

command

```
C:\Users\username>python enumerate.py
<enumerate object at 0x0000020F7F7F4F00>
[(0, 1), (1, 2), (2, 3), (3, 4), (4, 5)]
```

command

```
C:\Users\username>python enumerate.py
<enumerate object at 0x0000020F7F7F4F00>
[(0, 1), (1, 2), (2, 3), (3, 4), (4, 5)]
```

## filter()

The `filter()``filter()` method uses a filter function to exclude items in an iterable object. The syntax of the `filter()``filter()` method is: `filter(function, iterable)``filter(function, iterable)`. Here is an example:

filter.py

```
def is_even(number):
    return number % 2 == 0
 
numbers = [1, 2, 3, 4, 5]
even_numbers = filter(is_even, numbers)
print(even_numbers)
print(list(even_numbers))
```

filter.py

```
def is_even(number):
    return number % 2 == 0
 
numbers = [1, 2, 3, 4, 5]
even_numbers = filter(is_even, numbers)
print(even_numbers)
print(list(even_numbers))
```

Output:

command

```
C:\Users\username>python filter.py
<filter object at 0x0000020F7F7F4F00>
[2, 4]
```

command

```
C:\Users\username>python filter.py
<filter object at 0x0000020F7F7F4F00>
[2, 4]
```

## map()

The `map()``map()` method uses a map function to execute a specified function for each item in an iterable. The item is sent to the function as a parameter. The syntax of the `map()``map()` method is: `map(function, iterable)``map(function, iterable)`. Here is an example:

map.py

```
def square(number):
    return number * number
 
numbers = [1, 2, 3, 4, 5]
squared_numbers = map(square, numbers)
print(squared_numbers)
print(list(squared_numbers))
```

map.py

```
def square(number):
    return number * number
 
numbers = [1, 2, 3, 4, 5]
squared_numbers = map(square, numbers)
print(squared_numbers)
print(list(squared_numbers))
```

Output:

command

```
C:\Users\username>python map.py
<map object at 0x0000020F7F7F4F00>
[1, 4, 9, 16, 25]
```

command

```
C:\Users\username>python map.py
<map object at 0x0000020F7F7F4F00>
[1, 4, 9, 16, 25]
```

## reversed()

The `reversed()``reversed()` method returns a reversed iterator. The syntax of the `reversed()``reversed()` method is: `reversed(list)``reversed(list)`. Here is an example:

reversed.py

```
numbers = [1, 2, 3, 4, 5]
reversed_numbers = reversed(numbers)
print(reversed_numbers)
print(list(reversed_numbers))
```

reversed.py

```
numbers = [1, 2, 3, 4, 5]
reversed_numbers = reversed(numbers)
print(reversed_numbers)
print(list(reversed_numbers))
```

Output:

command

```
C:\Users\username>python reversed.py
<list_reverseiterator object at 0x0000020F7F7F4F00>
[5, 4, 3, 2, 1]
```

command

```
C:\Users\username>python reversed.py
<list_reverseiterator object at 0x0000020F7F7F4F00>
[5, 4, 3, 2, 1]
```

## sorted()

The `sorted()``sorted()` method returns a sorted list. The syntax of the `sorted()``sorted()` method is: `sorted(list)``sorted(list)`. Here is an example:

sorted.py

```
numbers = [5, 2, 3, 1, 4]
sorted_numbers = sorted(numbers)
print(sorted_numbers)
```

sorted.py

```
numbers = [5, 2, 3, 1, 4]
sorted_numbers = sorted(numbers)
print(sorted_numbers)
```

Output:

command

```
C:\Users\username>python sorted.py
[1, 2, 3, 4, 5]
```

command

```
C:\Users\username>python sorted.py
[1, 2, 3, 4, 5]
```

## zip()

The `zip()``zip()` method returns an iterator, from two or more iterators. The syntax of the `zip()``zip()` method is: `zip(iterator1, iterator2, iterator3, ...)``zip(iterator1, iterator2, iterator3, ...)`. Here is an example:

zip.py

```
numbers = [1, 2, 3, 4, 5]
fruits = ['apple', 'banana', 'cherry']
zipped = zip(numbers, fruits)
print(zipped)
print(list(zipped))
```

zip.py

```
numbers = [1, 2, 3, 4, 5]
fruits = ['apple', 'banana', 'cherry']
zipped = zip(numbers, fruits)
print(zipped)
print(list(zipped))
```

Output:

command

```
C:\Users\username>python zip.py
<zip object at 0x0000020F7F7F4F00>
[(1, 'apple'), (2, 'banana'), (3, 'cherry')]
```

command

```
C:\Users\username>python zip.py
<zip object at 0x0000020F7F7F4F00>
[(1, 'apple'), (2, 'banana'), (3, 'cherry')]
```

## del

The `del``del` keyword removes the specified index. The syntax of the `del``del` keyword is: `del list[index]``del list[index]`. Here is an example:

del.py

```
fruits = ['apple', 'banana', 'cherry']
del fruits[1]
print(fruits)
```

del.py

```
fruits = ['apple', 'banana', 'cherry']
del fruits[1]
print(fruits)
```

Output:

command

```
C:\Users\username>python del.py
['apple', 'cherry']
```

command

```
C:\Users\username>python del.py
['apple', 'cherry']
```

## in

The `in``in` keyword returns True if a sequence with the specified value is present in the list. The syntax of the `in``in` keyword is: `element in list``element in list`. Here is an example:

in.py

```
fruits = ['apple', 'banana', 'cherry']
print("banana" in fruits)
print("orange" in fruits)
```

in.py

```
fruits = ['apple', 'banana', 'cherry']
print("banana" in fruits)
print("orange" in fruits)
```

Output:

command

```
C:\Users\username>python in.py
True
False
```

command

```
C:\Users\username>python in.py
True
False
```

## not in

The `not in``not in` keyword returns True if a sequence with the specified value is not present in the list. The syntax of the `not in``not in` keyword is: `element not in list``element not in list`. Here is an example:

not-in.py

```
fruits = ['apple', 'banana', 'cherry']
print("banana" not in fruits)
print("orange" not in fruits)
```

not-in.py

```
fruits = ['apple', 'banana', 'cherry']
print("banana" not in fruits)
print("orange" not in fruits)
```

Output:

command

```
C:\Users\username>python not-in.py
False
True
```

command

```
C:\Users\username>python not-in.py
False
True
```
