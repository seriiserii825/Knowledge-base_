# Regexp

## remove attribute

```html
<div v-if="data.logos.idealista_it" class="promotion__logo">
  <img src="/images/logo-2.svg" alt="Logo 2" />
</div>
```

regexp:

```vim
:%s/img v-if="[^"]*"//
[^"]* - match any characters except double quotes
```

result:

```html
<div class="promotion__logo">
  <img src="/images/logo-2.svg" alt="Logo 2" />
</div>
