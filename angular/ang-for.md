## Angular — цикл `@for`

### Базовый синтаксис

    @for (item of items; track item.id) {
      <div>{{ item.name }}</div>
    }

### С индексом

    @for (item of items; track item.id; let i = $index) {
      <div>{{ i }} — {{ item.name }}</div>
    }

### Полезные переменные

    @for (
      item of items;
      track item.id;
      let i = $index;
      let first = $first;
      let last = $last;
      let even = $even;
      let odd = $odd
    ) {
      {{ i }}
      {{ first }}
      {{ last }}
      {{ even }}
      {{ odd }}
    }

Доступные переменные:

    $index  — индекс элемента
    $first  — первый элемент
    $last   — последний элемент
    $even   — чётный индекс
    $odd    — нечётный индекс
    $count  — количество элементов

### Если массив пустой

    @for (item of items; track item.id) {
      <div>{{ item.name }}</div>
    } @empty {
      <div>No items</div>
    }

### `track`

    track item.id

`track` помогает Angular определить, какой элемент массива
соответствует какому DOM-элементу.

Если уникального `id` нет:

    @for (item of items; track $index) {
      {{ item }}
    }``
