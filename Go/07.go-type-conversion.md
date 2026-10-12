# 03. Преобразование типов в Go

Go требует явного преобразования между разными типами данных.

## 1. Числовые типы

```go
age := 30
price := 99.99

ageFloat := float64(age) // int → float64
priceInt := int(price)   // float64 → int

fmt.Println(ageFloat) // 30
fmt.Println(priceInt) // 99
```

Важно: `int()` отбрасывает дробную часть, а не округляет.

## 2. Строка → число

Используется пакет `strconv`.

```go
import "strconv"

// string → int
age, err := strconv.Atoi("25")

// string → float64
price, err := strconv.ParseFloat("99.99", 64)
```

Функции возвращают значение и ошибку. Ошибку необходимо проверять:

```go
if err != nil {
    fmt.Println("Ошибка:", err)
    return
}
```

## 3. Число → строка

```go
import "strconv"

// int → string
age := strconv.Itoa(25)

// float64 → string
price := strconv.FormatFloat(99.99, 'f', 2, 64)
```

Не путать:

```go
string(65)         // "A" (Unicode)
strconv.Itoa(65)   // "65"
```

## 4. Преобразование bool

```go
// string → bool
active, err := strconv.ParseBool("true")

// int → bool через сравнение
status := 1
isActive := status != 0

// bool → string
text := strconv.FormatBool(true)
```

## 5. Форматирование через fmt.Sprintf()

`Sprintf()` возвращает строку, а не печатает её.

```go
price := 49.95
quantity := 3

result := fmt.Sprintf(
    "Total: $%.2f, Quantity: %d",
    price,
    quantity,
)

fmt.Println(result)
// Total: $49.95, Quantity: 3
```

## 6. Шпаргалка

| Задача                  | Решение                                  |
| ----------------------- | ---------------------------------------- |
| int → float64           | `float64(value)`                         |
| float64 → int           | `int(value)`                             |
| string → int            | `strconv.Atoi(value)`                    |
| string → float64        | `strconv.ParseFloat(value, 64)`          |
| int → string            | `strconv.Itoa(value)`                    |
| float64 → string        | `strconv.FormatFloat(value, 'f', 2, 64)` |
| string → bool           | `strconv.ParseBool(value)`               |
| bool → string           | `strconv.FormatBool(value)`              |
| Любое значение → строка | `fmt.Sprintf("%v", value)`               |
