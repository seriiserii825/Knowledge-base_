# Сортировка в Go

Основные способы сортировки — пакет `sort` (стандартный) и пакет `slices` (с Go 1.21).

## 1. sort.Ints / sort.Strings / sort.Float64s

Готовые функции для сортировки срезов встроенных типов по возрастанию.

```go
nums := []int{3, 1, 2}
sort.Ints(nums) // [1 2 3]

names := []string{"Bob", "Alice"}
sort.Strings(names) // [Alice Bob]
```

## 2. sort.Sort / sort.Interface

Сортировка произвольного типа через реализацию интерфейса `Len`, `Less`, `Swap`.

```go
type ByAge []Person

func (a ByAge) Len() int           { return len(a) }
func (a ByAge) Less(i, j int) bool { return a[i].Age < a[j].Age }
func (a ByAge) Swap(i, j int)      { a[i], a[j] = a[j], a[i] }

sort.Sort(ByAge(people))
```

## 3. sort.Slice

Сортировка любого среза с функцией-компаратором, без реализации интерфейса.

```go
sort.Slice(people, func(i, j int) bool {
    return people[i].Age < people[j].Age
})
```

## 4. sort.Stable / sort.SliceStable

Как `sort.Sort` / `sort.Slice`, но сохраняет исходный порядок равных элементов.

```go
sort.SliceStable(people, func(i, j int) bool {
    return people[i].Age < people[j].Age
})
```

## 5. sort.Search

Бинарный поиск позиции в уже отсортированном срезе.

```go
i := sort.Search(len(nums), func(i int) bool { return nums[i] >= 2 })
```

## 6. slices.Sort (пакет slices, Go 1.21+)

Аналог `sort.Ints`/`sort.Strings`, но работает с любым упорядочиваемым типом через generics.

```go
import "slices"

nums := []int{3, 1, 2}
slices.Sort(nums) // [1 2 3]
```

## 7. slices.SortFunc / slices.SortStableFunc

Аналог `sort.Slice` / `sort.SliceStable`, но с generics вместо `interface{}`.

```go
slices.SortFunc(people, func(a, b Person) int {
    return a.Age - b.Age
})
```

## 8. Проверка и обратный порядок

```go
slices.IsSorted(nums)          // true/false
sort.Sort(sort.Reverse(sort.IntSlice(nums))) // убывание
```

## Главное

- `sort.Ints` / `sort.Strings` / `sort.Float64s` — сортировка срезов встроенных типов.
- `sort.Slice` / `sort.SliceStable` — сортировка с функцией-компаратором.
- `sort.Sort` / `sort.Interface` — сортировка через `Len`/`Less`/`Swap`.
- `sort.Search` — бинарный поиск в отсортированном срезе.
- `slices.Sort` / `slices.SortFunc` / `slices.SortStableFunc` — generics-аналоги из пакета `slices` (Go 1.21+).
- `sort.Reverse` — сортировка в обратном порядке.
