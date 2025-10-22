# flex gallery

# php

```php
<?php
$gallery = get_field('gallery');
$title = $gallery['title'];
$button_text = $gallery['button_text'];
$images = $gallery['images'];
?>
<section class="gallery">
  <div class="container">
    <h2 class="gallery__title title"><?php echo $title; ?></h2>
  </div>
  <div class="gallery__wrap">
    <?php foreach ($images as $image) : ?>
      <?php
      $image = my_get_image_id($image);
      ?>
      <div class="gallery__item">
        <?php create_picture($image) ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

```

# css

```css
.gallery {
  padding-top: 3.2rem;
  &__title {
    margin-bottom: 6.4rem;
  }
  &__wrap {
    display: flex;
    height: 65rem;
  }
  &__item {
    position: relative;
    flex: 1 1 0;
    transition: all 0.6s ease-in-out;
    will-change: flex-grow;
    cursor: pointer;
    &:hover {
      flex-grow: 3;
    }
    img {
      position: absolute;
      top: 0;
      left: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
}
```
