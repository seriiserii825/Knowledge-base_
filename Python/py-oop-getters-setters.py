class Fruit:
    def __init__(self, name: str):
        # This is a private attribute
        self._name = name

    @property
    def name(self):
        return self._name

    @name.setter
    def name(self, value: str):
        print(f"Setting name: {value}")
        self._name = value


fruit: Fruit = Fruit("Apple")
print(fruit.name)
fruit.name = "Banana"
print(fruit.name)
