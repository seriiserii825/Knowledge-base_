# html break words

## on line

```css
/* 1-line ellipsis (single line) */
.clamp-1 {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
```

## on multiple lines

```css
.clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;          /* number of lines */
  -webkit-box-orient: vertical;
  overflow: hidden;
}
```
