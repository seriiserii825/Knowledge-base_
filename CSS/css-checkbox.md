### html

```html
<label class="checkbox">
  <input class="checkbox__input" type="checkbox" />
  <span class="checkbox__label">Согласен на всё</span>
</label>
```

### css

```css
.checkbox__input {
  appearance: none;
  display: inline-grid;
  place-content: center;

  width: 1rem;
  height: 1rem;

  background-color: lightskyblue;
  border: 0.1rem solid darkslategrey;
  border-radius: 0.25rem;
}

.checkbox__input:checked::after {
  content: "✓";
}
```
