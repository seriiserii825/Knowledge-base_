class Lamp:
    def __init__(self, name: str, model: str, version: str):
        self.name = name
        #private
        self.__model = model
        #protected
        self._version = version

    def description(self):
        self.__self_maintenance()
        print(self.name, self.__model)

    def __self_maintenance(self):
        print("Self maintenance")

lamp: Lamp = Lamp("Desk Lamp:", "Model 1", "1.0")
lamp.description()
print(lamp.name)

class Electric(Lamp):
    def __init__(self, name: str, model: str, version: str):
        super().__init__(name, model, version)

    def do_something(self):
        print(f"version: {self._version}")

l_lamp = Electric("L Lamp:", "Model 2", "1.1")
l_lamp.do_something()

# print(lamp.__model)  # AttributeError: 'Lamp' object has no attribute '__model'

