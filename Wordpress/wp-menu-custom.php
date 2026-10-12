<?php
$menu_locations = get_nav_menu_locations();
$menu_items = !empty($menu_locations['menu-1'])
  ? wp_get_nav_menu_items($menu_locations['menu-1'])
  : [];
$menu_items = $menu_items ?: [];
?>
<ul class="main-menu">
  <?php foreach ($menu_items as $menu_item): ?>
    <?php
    $title = $menu_item->title;
    $url = $menu_item->url;
    ?>
    <li>
      <a href="<?php echo esc_url($url); ?>" class="main-menu__link">
        <?php echo esc_html($title); ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
