# HTML Headings Rules (H1–H4)

## Basic Rules

### 1. One H1 per page

`<h1>` is the **main title of the page**.

```html
<h1>Page Title</h1>
```

Rules:

- Use **only one H1**
- Describes the **main topic of the page**

---

### 2. H2 — main sections

```html
<h2>Section Title</h2>
```

Used for **main sections of the page**.

Example:

```html
<h1>Coffee Guide</h1>

<h2>Types of Coffee</h2>
<h2>Brewing Methods</h2>
<h2>Storage</h2>
```

---

### 3. H3 — subsections

Used **inside H2 sections**.

```html
<h2>Brewing Methods</h2>

<h3>French Press</h3>
<h3>Espresso</h3>
<h3>Pour Over</h3>
```

---

### 4. H4 — deeper structure

Used **inside H3** for more detailed structure.

```html
<h3>Espresso</h3>

<h4>Grind Size</h4>
<h4>Water Temperature</h4>
```

---

### 5. Correct hierarchy

```
h1
 ├─ h2
 │   ├─ h3
 │   │   └─ h4
 │   └─ h3
 └─ h2
```

---

### 6. Do not skip levels

❌ Bad

```html
<h1>Title</h1>
<h3>Section</h3>
```

✅ Good

```html
<h1>Title</h1>
<h2>Section</h2>
<h3>Subsection</h3>
```

---

### 7. Do not use headings for styling

❌ Wrong

```html
<h3 class="small">Contact</h3>
```

✅ Correct

```html
<p class="small">Contact</p>
```

Headings are for **structure**, not styling.
