```js
// Добавить параметр
const url = new URL(window.location);

url.searchParams.set("page", "2");

history.pushState({}, "", url);

// Из:
// https://site.com/products
// Получится:
// https://site.com/products?page=2

// Обновить существующий параметр
const url2 = new URL(window.location);

url2.searchParams.set("category", "books");

history.replaceState({}, "", url2);

// Удалить параметр
const url3 = new URL(window.location);

url3.searchParams.delete("category");

history.replaceState({}, "", url3);

// Разница:
// pushState()    — добавляет запись в историю браузера
// replaceState() — заменяет текущий URL без новой записи в истории
```
