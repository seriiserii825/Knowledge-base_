## json schema

### install package

```bash
npm install -g json-schema-to-typescript
```

### from clipboard to file

```bash
xclip -selection clipboard -o > sample.json
```

### npm from network response json to json schema

```bash
npm i -D generate-schema
```

### Create infer-schema.mjs:

```ts
import fs from "node:fs";
import generateSchema from "generate-schema"; // uses the same engine as the CLI

const input = "sample.json";
const output = "schema.json";

// 1) Read your sample payload
const sample = JSON.parse(fs.readFileSync(input, "utf8"));

// 2) Infer a schema (root name used for title)
const schema = generateSchema.json("ProductsFilterResponse", sample);

// 3) Normalize to Draft-07 so json-schema-to-typescript is happy
schema.$schema = "http://json-schema.org/draft-07/schema#";

// (Optional but helpful) lock down extra props at top level:
schema.additionalProperties = false;

// 4) Write schema
fs.writeFileSync(output, JSON.stringify(schema, null, 2));
console.log(`✅ Wrote ${output}`);
```

### run infer-schema.mjs

```bash
node infer-schema.mjs
```

### generate typescript types

```bash
npx json-schema-to-typescript schema.json > products-filter-response.d.ts
```

### validate

```ts
// src/types/guards.ts
import Ajv from "ajv";
import schema from "../schemas/products-filter-response.schema.json"; // if you also import the schema
const ajv = new Ajv({ allErrors: true });

export const isProductsFilterResponse = ajv.compile(schema);

// usage
const res = await fetch("/wp-json/products-filter/v1/data");
const data = await res.json();

if (!isProductsFilterResponse(data)) {
  console.error(isProductsFilterResponse.errors);
  throw new Error("Bad API shape");
}

// now data is typed (if you cast) and validated:
type ProductsFilterResponse = import("../types/products-filter-response").ProductsFilterResponse;
const typed: ProductsFilterResponse = data;
```
