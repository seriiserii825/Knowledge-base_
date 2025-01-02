## in html template
```html
<input type="text" (input)="updateServerName($event)"/>
```

## in class
```typescript
updateServerName(event: Event) {
    this.serverName = (<HTMLInputElement>event.target).value;
}
```
