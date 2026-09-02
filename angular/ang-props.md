# Angular Binding — кратко

# Передача между компонентами

## Parent → Child — `input()`

Аналог `props` во Vue.

### Parent

```html
<app-user [name]="username" />
```

### Child

```ts
name = input<string>();
```

Использование:

```html
<h2>{{ name() }}</h2>
```

Обязательный prop:

```ts
name = input.required<string>();
```

---
