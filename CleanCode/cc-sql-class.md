## Sql class

```python

class Sql:
    def __init__(self, table, columns):
        pass

    def create(self):
        pass

    def insert(self, fields):
        pass

    def select_all(self):
        pass

    def find_by_key(self, key_column, key_value):
        pass

    def select(self, colu):  # имя аргумента "colu" оставлено как в оригинале
        pass

    def select(self, criteria):
        # перегрузка в Java, в Python перекроет предыдущий метод
        pass

    def prepared_insert(self):
        pass

    def column_list(self, columns):
        pass

    def values_list(self, fields, columns):
        pass

    def select_with_criteria(self, criteria):
        pass
```

### Базовый абстрактный класс

```python

from abc import ABC, abstractmethod

class Sql(ABC):
    def __init__(self, table, columns):
        pass

    @abstractmethod
    def generate(self):
        pass
```

### Подклассы

```python

from abc import ABC, abstractmethod

class Sql(ABC):
    def __init__(self, table, columns):
        self.table = table
        self.columns = columns

    @abstractmethod
    def generate(self):
        pass

class CreateSql(Sql):
    def __init__(self, table, columns):
        super().__init__(table, columns)

    def generate(self):
        pass

class SelectSql(Sql):
    def __init__(self, table, columns):
        super().__init__(table, columns)

    def generate(self):
        pass

class InsertSql(Sql):
    def __init__(self, table, columns, fields):
        super().__init__(table, columns)
        self.fields = fields

    def generate(self):
        pass

    def valuesList(self, fields, columns):
        pass

class SelectWithCriteriaSql(Sql):
    def __init__(self, table, columns, criteria):
        super().__init__(table, columns)
        self.criteria = criteria

    def generate(self):
        pass

class SelectWithMatchSql(Sql):
    def __init__(self, table, columns, column, pattern):
        super().__init__(table, columns)
        self.column = column
        self.pattern = pattern

    def generate(self):
        pass

class FindByKeySql(Sql):
    def __init__(self, table, columns, keyColumn, keyValue):
        super().__init__(table, columns)
        self.keyColumn = keyColumn
        self.keyValue = keyValue

    def generate(self):
        pass

class PreparedInsertSql(Sql):
    def __init__(self, table, columns):
        super().__init__(table, columns)

    def generate(self):
        pass

    def placeholderList(self, columns):
        pass

class Where:
    def __init__(self, criteria):
        self.criteria = criteria

    def generate(self):
        pass
```

### Основные изменения при конвертации

1. Абстрактный класс `Sql` теперь наследуется от `ABC`
2. Абстрактный метод помечен декоратором `@abstractmethod`
3. Конструкторы переименованы в `__init__`
4. Все методы принимают `self` в качестве первого параметра
5. Для вызова родительского конструктора используется `super().__init__()`
6. Реализации методов оставлены пустыми (`pass`),
   так как в исходном коде они не были показаны

Код каждого класса становится до смешного простым. Время, необходимое для
понимания класса, падает почти до нуля. Вероятность того, что одна из функций
нарушит работу другой, ничтожно мала. С точки зрения тестирования проверка
всех фрагментов логики в этом решении упрощается, поскольку все классы изолированы друг от друга.

Что не менее важно, когда придет время добавления update, вам не придется изменять ни один из существующих классов! Логика построения команды update
реализуется в новом субклассе Sql с именем UpdateSql. Это изменение не нарушит работу другого кода в системе.

Наш переработанный класс Sql открыт для добавления новой
функциональности посредством создания производных классов, но при внесении этого изменения все остальные классы остаются закрытыми. Новый класс
UpdateSql просто размещается в положенном месте.

Структура системы должна быть такой, чтобы обновление системы (с добавлением новых или изменением существующих аспектов) создавало как можно
меньше проблем. В идеале новая функциональность должна реализовываться
расширением системы, а не внесением изменений в существующий код.
