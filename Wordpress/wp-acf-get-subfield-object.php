<?php
// Получаем основное поле группы
if (have_rows('products_list')) :
  while (have_rows('products_list')) : the_row();

    $title = get_sub_field('title');
    $label = get_sub_field('label');

    if (have_rows('items')) :
?>
      <section class="products-list">
        <div class="container">
          <h2 class="products-list__title"><?php echo esc_html($title); ?></h2>

          <?php while (have_rows('items')) : the_row();
            $image = get_sub_field('image');
            $subtitle = get_sub_field('subtitle');
            $text = get_sub_field('text');
            $seasonability_selected = get_sub_field('seasonability') ?: [];

            // Получаем объект поля seasonability, чтобы вывести все возможные варианты
            $seasonability_field = get_sub_field_object('seasonability');
            $all_choices = $seasonability_field['choices'] ?? [];
          ?>
            <div class="products-list__item">
              <div class="products-list__before before">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/i/static/left-side-cropped.png" alt="">
              </div>
              <div class="products-list__row">
                <div class="products-list__img">
                  <?php create_picture(my_get_image_id($image)); ?>
                </div>
                <div class="products-list__content">
                  <h3 class="products-list__subtitle"><?php echo esc_html($subtitle); ?></h3>
                  <div class="products-list__text"><?php echo esc_html($text); ?></div>
                </div>
                <div class="products-list__seasonability">
                  <h4 class="products-list__label"><?php echo esc_html($label); ?></h4>
                  <div class="products-list__items">
                    <?php foreach ($all_choices as $value => $label_choice) :
                      $active = in_array($value, $seasonability_selected) ? 'active' : '';
                    ?>
                      <div class="products-list__check <?php echo $active; ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/i/static/seasonability.png" alt="decor">
                        <div class="products-list__circle"></div>
                        <div class="products-list__month"><?php echo esc_html($label_choice); ?></div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <div class="products-list__before after">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/i/static/left-side-cropped.png" alt="">
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </section>
<?php
    endif; // end items
  endwhile; // end products_list
endif; // end have_rows('products_list')
?>
