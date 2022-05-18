## Resize svg to 1x1 px and export from figma and add a clip-path with id

```html
<div class="block">
  <svg width="0" height="0" fill="none" xmlns="http://www.w3.org/2000/svg">
    <clipPath clipPathUnits="objectBoundingBox" id="cantonClip">
      <path
        fill-rule="evenodd"
        clip-rule="evenodd"
        d="M1.00052 0.160796V0C0.927767 0.122447 0.631899 0.158201 0.49262 0.160796H0.492188V0.160804V0.839188H1.00052V0.160804V0.160796ZM1.00052 1V0.839196H0.492188C0.631286 0.841725 0.927691 0.877426 1.00052 1Z"
        fill="#042B2E"
        fill-opacity="0.5"
        style="mix-blend-mode: lighten"
      />
      <rect y="0.160645" width="0.491667" height="0.678392" fill="#042B2E" />
    </clipPath>
  </svg>
</div>
```

## add a clip-path id to css wrapper

```scss
.block {
  clip-path: url(#cantonClip);
}
```
