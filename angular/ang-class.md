# Angular — классы

```html
<!-- Обычный -->
<div class="card"></div>

<!-- По условию -->
<div [class.active]="isActive"></div>

<!-- Обычный + условный -->
<div class="card" [class.active]="isActive"></div>

<!-- Несколько -->
<div
  [class]="{
  active: isActive,
  disabled: isDisabled
}"
></div>

<!-- Динамический -->
<div [class]="className"></div>
```

```ts
isActive = true;
isDisabled = false;
className = "active";
```

`[class.active]="true"` → добавит класс `active`.
