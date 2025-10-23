# Отличный вопрос 💪

## Объяснение разницы между interface и abstract class в TypeScript

Вот ты как раз подошёл к главному отличию между interface и abstract class.
Разберём это на том же примере с фигурами (Shape), чтобы было максимально понятно.

### 🧩 1. Повторим: abstract class

```ts
abstract class Shape {
    abstract area(): number; // обязательный метод для всех потомков

    describe(): void {
        console.log("Это геометрическая фигура");
    }
}

class Circle extends Shape {
    constructor(private radius: number) {
        super();
    }

    area(): number {
        return Math.PI _ this.radius _ this.radius;
    }
}
```

### 🧠 Здесь:

Shape может содержать и абстрактные, и обычные методы.
Можно наследоваться только от одного абстрактного класса (extends).
Можно хранить состояние (поля, например protected color: string).
Используется как частично реализованный шаблон.

### 🧩 2. Та же идея, но через interface

```ts
interface Shape {
    area(): number; // обязательный метод
    describe(): void; // тоже обязательный, но без реализации
}

class Circle implements Shape {
    constructor(private radius: number) {}

    area(): number {
        return Math.PI _ this.radius _ this.radius;
    }

    describe(): void {
        console.log("Это круг");
    }
}
```

### 🧠 Здесь:

interface определяет контракт — только форму, без реализации.

Класс может реализовать несколько интерфейсов (множественное наследование интерфейсов).

Интерфейс не может содержать реализацию или состояние — только описание методов и свойств.

### 🔍 Разница кратко

Отличие interface abstract class
Содержит реализацию ❌ Нет ✅ Может иметь
Хранит состояние (поля) ❌ Нет ✅ Может
Множественная реализация ✅ Можно implements A, B, C ❌ Только один extends
Используется для Контрактов типов Базовых шаблонов с логикой
После компиляции Полностью исчезает Остаётся в JS-коде
Создать экземпляр Нельзя Нельзя

### 💡 Пример, когда интерфейс лучше

Если тебе нужно просто гарантировать,
что у объектов будут нужные методы (например, area),
но без общей логики:

```ts
interface Shape {
    area(): number;
}

class Circle implements Shape {
    constructor(private r: number) {}
    area() {
        return Math.PI _ this.r _ this.r;
    }
}

class Square implements Shape {
    constructor(private s: number) {}
    area() {
        return this.s \* this.s;
    }
}
```

### ✅ Интерфейс → минимум зависимостей, легко расширять, идеально для OCP.

### 💡 Пример, когда абстрактный класс лучше

Если у всех фигур есть общая логика:

```ts
abstract class Shape {
    constructor(protected color: string) {}

    abstract area(): number;

    printColor() {
        console.log("Цвет фигуры:", this.color);
    }
}

class Circle extends Shape {
    constructor(color: string, private r: number) {
        super(color);
    }
    area() {
        return Math.PI _ this.r _ this.r;
    }
}
```

### ✅ Абстрактный класс → позволяет переиспользовать код (например printColor())

### 🧠 Итого

Интерфейс (interface) — чистый контракт (что должно быть).

Абстрактный класс (abstract class) — шаблон (что должно быть + немного как должно работать).
