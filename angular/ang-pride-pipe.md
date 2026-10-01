# angular price pipe

```ts
<!-- $1,299.99 -->

{{ price | currency:'USD' }}

<!-- €1,299.99 -->

{{ price | currency:'EUR' }}

<!-- 1.299,99 € depending on configured locale -->

{{ price | currency:'EUR':'symbol':'1.2-2' }}

<!-- USD 1,299.99 -->

{{ price | currency:'USD':'code' }}

<!-- $1,300 — no decimals -->

{{ price | currency:'USD':'symbol':'1.0-0' }}
```
