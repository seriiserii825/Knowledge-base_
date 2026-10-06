# Angular - Route Params & Query Params

## Route param

URL:

/products/123

Route:

```ts
{
path: 'products/:id',
component: ProductPage,
}
```

Get param with snapshot:

```ts
import { inject } from "@angular/core";
import { ActivatedRoute } from "@angular/router";

export class ProductPage {
  private route = inject(ActivatedRoute);

  id = this.route.snapshot.paramMap.get("id");
}
```

Observable version:

```ts
import { map } from "rxjs";

export class ProductPage {
  private route = inject(ActivatedRoute);

  id$ = this.route.paramMap.pipe(map((params) => params.get("id")));
}
```

Use Observable when the param can change while the same component stays mounted.

## get product by id

```ts
export class SingleProductPage {
  productService = inject(ProductService);
  route = inject(ActivatedRoute);

  product$ = this.route.paramMap.pipe(
    map((params) => params.get("id")!),
    switchMap((id) => this.productService.getOne(id)),
    map((response) => response),
  );
}
```
