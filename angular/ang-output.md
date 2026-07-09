# Output (события от child к parent)

`output()` — способ дочернего компонента "выстрелить" событием наружу, к родителю. Работает связкой: `emit()` в child + event binding `(...)` в родителе.

## В дочернем компоненте

```typescript
import { Component, output } from "@angular/core";

@Component({
  selector: "app-child",
  template: `<button (click)="onClick()">change name</button>`,
})
export class Child {
  nameChange = output<string>();

  onClick() {
    this.nameChange.emit("name from child");
  }
}
```

## В родителе

```html
<app-child (nameChange)="setNewName($event)"></app-child>
```

```typescript
setNewName(value: string) {
  this.name.set(value);
}
```

## Как это работает

- Имя свойства output (`nameChange`) — это и есть имя события в шаблоне родителя: `(nameChange)`. Метод, который вызывает `.emit()` (в примере `onClick`), к имени события отношения не имеет и может называться как угодно.
- `.emit(value)` передаёт значение наружу; в родителе оно доступно через `$event`.
- output — просто "труба наружу", без встроенной логики. Родитель сам решает, что делать со значением (например, записать в signal через `.set()`).

## Частая ошибка

Слушать в родителе имя метода из child вместо имени output:

```html
<!-- неправильно: changeNameFromChild — это метод child, а не output -->
<app-child (changeNameFromChild)="setNewName($event)"></app-child>
```

Angular не выдаёт ошибку компиляции на несуществующий output в некоторых случаях — просто обработчик никогда не вызовется, потому что событие с таким именем никто не эмитит.

Вторая типичная ловушка: даже если emit долетел, но input в родителе привязан к литералу (`[name]="'hello world'"`) вместо сигнала/переменной (`[name]="name()"`), child всё равно не увидит изменений — потому что новое значение вообще никуда не прокидывается обратно во view.
