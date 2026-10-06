# Fetch

## Fetch observable

home-page.ts

```bash
export class HomePage {
    publicUrl = PUBLIC_URL
    private productService = inject(ProductService)
    latestProducts$ = this.productService.getLatest(8)
}
```

home-page.html

```html
@if (latestProducts$ | async; as latestProducts) {
<div class="container mb-16">
  <app-section-header title="Latest Products" description="Check out our latest products" />
  <app-products-grid [products]="latestProducts" />
</div>
}
```

## Imperative fetch

home-page.ts

```bash
export class HomePage implements OnInit {
  publicUrl = PUBLIC_URL
  private productService = inject(ProductService)

  latestProducts: Product[] = []

  ngOnInit() {
    this.productService.getLatest(8).subscribe(products => {
      this.latestProducts = products
    })
  }
}
```

home-page.html

```html
@if (latestProducts.length) {
<div class="container mb-16">
  <app-section-header title="Latest Products" description="Check out our latest products" />

  <app-products-grid [products]="latestProducts" />
</div>
}
```
