## Child → Parent — `output()`

### Child

```ts
selected = output<string>();

selectUser() {
  this.selected.emit('Sergiu');
}
```

### Parent

```html
<app-user (selected)="onSelected($event)" />
```

```ts
onSelected(name: string) {
  console.log(name);
}
```

### Child HTML:

(click)="selected.emit(value)"

        ↓

### Parent HTML:

(selected)="onSelected($event)"
