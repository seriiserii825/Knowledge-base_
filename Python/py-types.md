# Types

## NameTuple

when to use: When you need a simple immutable data structure with named fields.

```python
from typing import NamedTuple

class Coordinates(NamedTuple):
    latitude: float
    longitude: float

class getCoordinates(api: str) -> Coordinates:
    return Coordinates(latitude=0.0, longitude=0.0)
```

## TypeDict

when to use: When you need a dictionary-like structure with a fixed set of keys
and types.

```python
from typing import TypedDict

class UserProfile(TypedDict):
    username: str
    age: int
    is_active: bool

# Example usage
def print_user_info(user: UserProfile) -> None:
    print(f"Username: {user['username']}")
    print(f"Age: {user['age']}")
    print(f"Active: {user['is_active']}")

user1: UserProfile = {
    "username": "alice",
    "age": 30,
    "is_active": True,
}

print_user_info(user1)

```

## @dataclass

when to use: When you need to change the data structure,
or when you need to add methods

```python
from dataclasses import dataclass

@dataclass
class Point:
    x: int
    y: int

    def distance_to_origin(self) -> float:
        return (self.x**2 + self.y**2) ** 0.5

p1 = Point(3, 4)
print(p1.distance_to_origin())  # Output: 5.0
```
