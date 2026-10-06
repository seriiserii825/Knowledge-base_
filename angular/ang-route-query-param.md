## Query param

URL:

/products?page=2&category=phones

Get query params with snapshot:

```ts
import { inject } from "@angular/core";
import { ActivatedRoute } from "@angular/router";

export class ProductsPage {
  private route = inject(ActivatedRoute);

  page = this.route.snapshot.queryParamMap.get("page");
  category = this.route.snapshot.queryParamMap.get("category");
}
```

Observable version:

```ts
import { map } from "rxjs";

page$ = this.route.queryParamMap.pipe(map((params) => params.get("page")));
```
