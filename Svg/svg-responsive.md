## First method

#### php

```php

  <div class="line">
    <?php get_template_part('template-parts/icons/icon-what-we-do'); ?>
  </div>
```

#### php

```php
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 552 34">
  <path stroke="#fff" stroke-opacity=".4" d="M1 1h310.565l14.025 14.051h123.224L462.84 1H551v14.051" />
  <path stroke="#fff" stroke-opacity=".7" stroke-width="2" d="M1 33.117V1h33.561M535.472 1.502h15.027v13.047" />
</svg>
```

#### scss

```scss
.line {
  position: absolute;
  top: -1px;
  left: 0;
  display: block;
  width: calc(100% + 1px);
  height: 100%;
  svg {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    z-index: 2;
  }
  &::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 1px;
    height: 100%;
    background: #4e5553;
    z-index: 1;
  }
}
```

## second method

#### First change your CSS. Remove the `object-fit` and `object-position` properties.

```css
.fullscreen-map {
  position: absolute;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  min-width: 1020px;
  z-index: -1;
}
```

#### Next, you need to modify your SVG. In the root `<svg>` tag, make the following changes:

- Remove the `width` and `height` attributes.
- Add the following attributes:

#### svg

```xml

viewBox="0 0 1920 1080"
preserveAspectRatio="xMinYMin slice"
```

#### Your SVG should look like this now:

```xml

<svg
   xmlns:dc="http://purl.org/dc/elements/1.1/"
   xmlns:cc="http://creativecommons.org/ns#"
   xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
   xmlns:svg="http://www.w3.org/2000/svg"
   xmlns="http://www.w3.org/2000/svg"
   xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
   xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
   version="1.1"
   viewBox="0 0 1920 1080"
   preserveAspectRatio="xMinYMin slice"
   id="svg3157"
   inkscape:version="0.92.1 r15371"
   sodipodi:docname="europe3.svg">
```

#### Explanation of the attributes:

```
preserveAspectRatio="xMinYMin slice"
is the equivalent of your `object-fit` settings for SVGs.
The `viewBox` is needed so the browser knows how much it needs to scale the SVG contents.
```
