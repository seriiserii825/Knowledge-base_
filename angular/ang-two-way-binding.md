## input component ts
```typescript

export class InputComponent {
  @Input() label: string = '';
  @Input() value: string = '';
  @Input() name: string = '';

  @Output() valueChange = new EventEmitter<string>();

  onInput(event: Event) {
    this.value = (<HTMLInputElement>event.target).value;
    this.valueChange.emit(this.value);
  }
}
``````

## input component html
```html
<label class="block font-bold mb-1" *ngIf="label" [for]="name">{{ label }}</label>
<input class="border border-gray-300 w-full indent-2" (input)="onInput($event)" type="text" [value]="value" [name]="name" [id]="name"/>
```

## outer component typescript
```typescript
export class CockpitComponent {
  server_name = '';

  getServerName(value: string) {
    this.server_name = value;
  }
}
``````

## outer component html
```html

<app-input label="Server Name" [value]="server_name" name="server_name" (valueChange)="getServerName($event)"></app-input>
```
