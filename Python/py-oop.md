### инкапсуляция
- это когда мы скрываем данные от пользователя
- это делается с помощью двойного подчеркивания перед именем переменной
- это делается для того чтобы не дать пользователю изменять данные напрямую

Пример:

```py
class Rectangle :
    'Это класс Rectangle'
    # Способ создания объекта (конструктор)
    def __init__(self, width, height):         
        self.__width= width
        self.__height = height

    def getWidth(self):        
        return self.__width
     
    def getHeight(self):        
        return self.__height
 
    # Метод расчета площади.
    def getArea(self):
        return self.__width * self.__height
```

### наследование
- это когда один класс наследует свойства другого класса
- это делается с помощью ключевого слова `class`
- это делается для того чтобы не писать один и тот же код несколько раз

Пример:

```py
class Square(Rectangle):
    'Это класс Square'
    # Способ создания объекта (конструктор)
    def __init__(self, side):         
        self.__width= side
        self.__height = side
```


### полиморфизм
Использовании единственной сущности(метод, оператор или объект) для представления различных типов в различных сценариях использования.
- это когда один метод может работать по-разному в разных классах
- это делается с помощью ключевого слова `def`
- переопределение методов в дочерних классах

Пример:

```py
class Rectangle :
    'Это класс Rectangle'
    # Способ создания объекта (конструктор)
    def __init__(self, width, height):         
        self.__width= width
        self.__height = height

    def getWidth(self):        
        return self.__width
     
    def getHeight(self):        
        return self.__height
 
    # Метод расчета площади.
    def getArea(self):
        return self.__width * self.__height

class Square(Rectangle):
    'Это класс Square'
    # Способ создания объекта (конструктор)
    def __init__(self, side):         
        self.__width= side
        self.__height = side

    # Метод расчета площади.
    def getArea(self):
        return self.__width * self.__width
```

### абстракция
- это когда мы скрываем сложные детали от пользователя
- это делается с помощью ключевого слова `pass`
- это делается для того чтобы не путать пользователя


## class

```
class Rectangle :
    'Это класс Rectangle'
    # Способ создания объекта (конструктор)
    def __init__(self, width, height):         
        self.width= width
        self.height = height

    def getWidth(self):        
        return self.width
     
    def getHeight(self):        
        return self.height
 
    # Метод расчета площади.
    def getArea(self):
        return self.width * self.height
```

## Конструктор с аргументами по умолчанию

В других языках программирования конструкторов может быть несколько. В Python — только один. Но этот язык разрешает задавать значение по умолчанию.

> Все требуемые аргументы нужно указывать до аргументов со значениями по умолчанию.

```py
class Person:
    # Параметры возраста и пола имеют значение по умолчанию.
    def __init__(self, name, age=1, gender="Male"):
        self.name = name
        self.age = age 
        self.gender= gender
         
    def showInfo(self):
        print("Name: ", self.name)
        print("Age: ", self.age)
        print("Gender: ", self.gender)
```

Например:

```py
from person import Person
 
# Создать объект Person.
aimee = Person("Aimee", 21, "Female")
aimee.showInfo()
print(" --------------- ")
 
# возраст по умолчанию, пол.
alice = Person( "Alice" )
alice.showInfo()
 
print(" --------------- ")
 
# Пол по умолчанию.
tran = Person("Tran", 37)
tran.showInfo()
```

## Атрибуты

В Python есть два похожих понятия, которые на самом деле отличаются:

1. Атрибуты
2. Переменные класса

Стоит разобрать на практике:

```py
class Player:
    # Переменная класса
    minAge  = 18
    maxAge = 50
     
    def __init__(self, name, age):
        self.name = name
        self.age = age
```

### Пример наследования класса в Python

Копировать Скопировано Use a different Browser

```python
class Parent:  # объявляем родительский класс  
    parent_attr = 100  
  
    def __init__(self):  
        print('Вызов родительского конструктора')  
  
    def parent_method(self):  
        print('Вызов родительского метода')  
  
    def set_attr(self, attr):  
        Parent.parent_attr = attr  
  
    def get_attr(self):  
        print('Атрибут родителя: {}'.format(Parent.parent_attr))  
  
  
class Child(Parent):  # объявляем класс наследник  
    def __init__(self):  
        print('Вызов конструктора класса наследника')  
  
    def child_method(self):  
        print('Вызов метода класса наследника')  
  
  
c = Child()  # экземпляр класса Child  
c.child_method()  # вызов метода child_method  
c.parent_method()  # вызов родительского метода parent_method  
c.set_attr(200)  # еще раз вызов родительского метода  
c.get_attr()  # снова вызов родительского метода
```


## Переопределение методов

Вы всегда можете переопределить методы родительского класса. В вашем подклассе могут понадобиться специальные функции. Это одна из причин переопределения родительских методов.

**Пример переопределения методов**:

Копировать Скопировано Use a different Browser

```python
class Parent:  # объявите родительский класс  
    def my_method(self):  
        print('Вызов родительского метода')  
  
  
class Child(Parent):  # объявите класс наследник  
    def my_method(self):  
        print('Вызов метода наследника')  

  
c = Child()  # экземпляр класса Child  
c.my_method()  # метод переопределен классом наследником
```
