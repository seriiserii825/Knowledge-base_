# Intro

Стратегия компактных функций и коротких списков параметров иногда приводит
к росту переменных экземпляров, используемых подмножеством методов.
Это почти всегда свидетельствует о том,
что по крайней мере один класс пытается выделиться из более крупного класса.
Постарайтесь разделить переменные и методы на два и более класса,
чтобы новые классы обладали более высокой связностью.

## Пример плохого кода

```python

class UserManager:
    def __init__(self, username, email, password, filepath):
        self.username = username
        self.email = email
        self.password = password
        self.filepath = filepath

    def validate_email(self):
        return "@" in self.email

    def check_password_strength(self):
        return len(self.password) > 8

    def save_to_file(self):
        with open(self.filepath, "w") as f:
            f.write(f"{self.username}, {self.email}, {self.password}")

    def load_from_file(self):
        with open(self.filepath, "r") as f:
            data = f.read().split(", ")
            self.username, self.email, self.password = data
```

Проблема: методы save_to_file и load_from_file используют только filepath,
а validate_email и check_password_strength — только email и password.
Это говорит о двух разных подзадачах в одном классе:
управление пользователем и работа с файлом.

## Пример хорошего кода

```python

class User:
    def __init__(self, username, email, password):
        self.username = username
        self.email = email
        self.password = password

    def validate_email(self):
        return "@" in self.email

    def check_password_strength(self):
        return len(self.password) > 8


class UserStorage:
    def __init__(self, filepath):
        self.filepath = filepath

    def save(self, user: User):
        with open(self.filepath, "w") as f:
            f.write(f"{user.username}, {user.email}, {user.password}")

    def load(self):
        with open(self.filepath, "r") as f:
            data = f.read().split(", ")
            return User(*data)
```

- User отвечает только за данные и их валидацию
- UserStorage отвечает только за сохранение/загрузку
- Каждый класс теперь обладает высокой связностью, и их легче тестировать,
  расширять, переиспользовать
