### css

```scss
.map-wrapper:not(.is-active) * {
  pointer-events: none;
}
```

### js

```js
const mapWrapper = document.querySelector(".map-wrapper");
mapWrapper.addEventListener("click", () => {
  mapWrapper.classList.toggle("is-active");
});
```
