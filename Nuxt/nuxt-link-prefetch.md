# Nuxt Link

## Enable

```vue
<NuxtLink to="/about">About Us</NuxtLink>
- prefetch enabled by default
```

## disable prefetch

```vue
<NuxtLink to="/contact" no-prefetch>Contact Us</NuxtLink>
- prefetch disabled
```

## on action

- interaction: on hover or focus
- visibility: when the link is visible in the viewport

```vue
<NuxtLink to="/blog" prefetch-on="interaction|visibility">Blog</NuxtLink>
- prefetch on hover
```
