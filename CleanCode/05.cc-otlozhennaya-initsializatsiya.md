# Отложенная инициализация в Python

**Разделение фазы инициализации и логики времени выполнения а также проблемы,
связанные с отложенной инициализацией:**

Проблемный подход (смешение инициализации и логики выполнения)

```python
class Service:
    def execute(self):
        return "Real service execution"

class Client:
    def __init__(self):
        self._service = None  # Отложенная инициализация

    def get_service(self):
        if self._service is None:
            self._service = Service()  # Жёсткая зависимость
        return self._service

    def do_something(self):
        service = self.get_service()
        return service.execute()
```

**Проблемы:**

1. Жёсткая зависимость от класса `Service`
2. Смешана логика инициализации и выполнения
3. Трудно тестировать (нужно подменять `_service` после инициализации)
4. Нет гибкости в выборе реализации сервиса

### Улучшенный подход (разделение инициализации и выполнения)

```python
from abc import ABC, abstractmethod

# Абстракция сервиса
class IService(ABC):
    @abstractmethod
    def execute(self):
        pass

# Реальная реализация
class RealService(IService):
    def execute(self):
        return "Real service execution"

# Тестовая реализация
class MockService(IService):
    def execute(self):
        return "Mock service execution"

# Клиентский код
class Client:
    def __init__(self, service: IService):  # Внедрение зависимости
        self._service = service  # Инициализация при создании

    def do_something(self):  # Чистая логика выполнения
        return self._service.execute()

# Фабрика/контейнер для инициализации
class AppFactory:
    @staticmethod
    def create_client(use_mock=False):
        service = MockService() if use_mock else RealService()
        return Client(service)

# Использование
if __name__ == "__main__":
    # Фаза инициализации
    client = AppFactory.create_client(use_mock=True)

    # Фаза выполнения
    print(client.do_something())  # Вывод: "Mock service execution"
```

**Преимущества:**

1. Чёткое разделение инициализации (в `AppFactory`) и логики выполнения (в `Client`)
2. Зависимости внедряются явно через конструктор (Dependency Injection)
3. Легко тестировать - можно подменить реализацию `IService`
4. Гибкость - реализация сервиса определяется в одном месте (фабрика)
5. Соблюдение принципа единой ответственности

Этот пример следует принципам:

- Dependency Injection (внедрение зависимостей)
- Inversion of Control (инверсия управления)
- Separation of Concerns (разделение ответственности)
- Dependency Inversion Principle
  (принцип инверсии зависимостей через абстракцию `IService`)

Такой подход особенно полезен в больших приложениях,
где важно централизованное управление зависимостями
и чёткое разделение фаз инициализации и выполнения.
