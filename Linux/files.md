### Rename
```
find . -name "*.css" -exec sh -c 'f="{}"; mv -- "$f" "${f%.css}.min.css"' \;
```
