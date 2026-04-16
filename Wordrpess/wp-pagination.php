<?php
$current_page = isset($_GET['pg']) ? max(1, (int)$_GET['pg']) : 1;
$term_slug    = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';
$per_page     = 12;
$offset       = ($current_page - 1) * $per_page;

$section_id      = "js-corsi";
$courses_page_id = get_the_ID();

$query_args = [
  "post_type"      => "corso",
  "posts_per_page" => $per_page,
  "offset"         => $offset,
];

if ($term_slug) {
  $query_args['tax_query'] = [[
    'taxonomy' => 'categoria',
    'field'    => 'slug',
    'terms'    => $term_slug,
  ]];
}

$courses = new WP_Query($query_args);

$total_posts = $courses->found_posts;
$total_pages = ceil($total_posts / $per_page);

// Helper: build paginate URL preserving term filter
$base_url   = get_the_permalink($courses_page_id);
$term_param = $term_slug ? '&term=' . urlencode($term_slug) : '';
function paginate_url($base, $pg, $term_param, $anchor)
{
  return $base . '?pg=' . $pg . $term_param . '#' . $anchor;
}
?>
<section class="course-list" id="<?php echo $section_id; ?>">
  <div class="container">
    <div class="course-list__grid">
      <?php
      while ($courses->have_posts()) : $courses->the_post() ?>
        <?php
        $title = get_the_title();
        $image = get_the_post_thumbnail_url();
        $single_course = get_field("single_course");
        $azienda = $single_course["azienda"];
        $durata_in_ore = $single_course["durata_in_ore"];
        $terms = get_the_terms(get_the_ID(), "categoria");
        $term_name = isset($terms[0]) ? $terms[0]->name : "";
        $video = get_field("video");
        $has_video = $video['items'][0]['url'] ?? false;
        $materiali = get_field("materiali");
        $has_materiali = $materiali['items'][0]['url'] ?? false;
        ?>
        <div class="course-list__item">
          <a href="<?php echo get_the_permalink(); ?>" class="course-list__img">
            <?php create_picture(my_get_image_id($image)) ?>
            <?php if ($term_name) : ?>
              <div class="course-list__category">
                <?php echo $term_name; ?>
              </div>
            <?php endif; ?>
          </a>
          <div class="course-list__content">
            <header class="course-list__header">
              <?php
              $hour_label = $durata_in_ore == 1 ? "ora" : "ore";
              ?>
              <div class="course-list__hours">
                <?php get_template_part('template-parts/icons/icon-clock'); ?>
                <?php echo $durata_in_ore; ?> <?php echo $hour_label; ?> circa
              </div>
              <div class="course-list__company">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/i/static/<?php echo $azienda ?>.svg" alt="Azienda">
              </div>
            </header>
            <h3 class="course-list__title"><?php echo $title; ?></h3>
            <footer class="course-list__footer">
              <div class="course-list__labels">
                <?php if ($has_video) : ?>
                  <div class="course-list__label">
                    <?php get_template_part('template-parts/icons/icon-check'); ?>
                    Video
                  </div>
                <?php endif; ?>
                <?php if ($has_materiali) : ?>
                  <div class="course-list__label">
                    <?php get_template_part('template-parts/icons/icon-check'); ?>
                    Materiali
                  </div>
                <?php endif; ?>
              </div>
              <a href="<?php echo get_the_permalink(); ?>" class="course-list__permalink">
                <?php get_template_part('template-parts/icons/icon-next'); ?>
              </a>
            </footer>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <?php if ($total_pages > 1) : ?>
      <?php
      $current_page = max(1, min((int)$current_page, (int)$total_pages));
      $window = 3; // how many pages to show around the current one
      $prev_page = max(1, $current_page - 1);
      $next_page = min($total_pages, $current_page + 1);
      // Determine window range
      $start = max(2, $current_page - 1);
      $end   = min($total_pages - 1, $current_page + 1);
      // Adjust if near the edges
      if ($current_page <= 3) {
        $start = 2;
        $end = min($total_pages - 1, $window + 1);
      } elseif ($current_page >= $total_pages - 2) {
        $start = max(2, $total_pages - $window);
        $end = $total_pages - 1;
      }
      ?>
      <ul class="paginate">
        <!-- Prev -->
        <li class="paginate__arrow<?= $current_page == 1 ? ' disabled' : '' ?>">
          <a href="<?php echo paginate_url($base_url, $prev_page, $term_param, $section_id); ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
        <!-- Always show first page -->
        <li>
          <a href="<?php echo paginate_url($base_url, 1, $term_param, $section_id); ?>" class="<?php echo $current_page == 1 ? 'active' : ''; ?>">01</a>
        </li>
        <!-- Left dots -->
        <?php if ($start > 2) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>
        <!-- Middle window -->
        <?php for ($i = $start; $i <= $end; $i++) : ?>
          <li>
            <a href="<?php echo paginate_url($base_url, $i, $term_param, $section_id); ?>" class="<?php echo $current_page == $i ? 'active' : ''; ?>"><?php echo $i; ?></a>
          </li>
        <?php endfor; ?>
        <!-- Right dots -->
        <?php if ($end < $total_pages - 1) : ?>
          <li class="paginate__dots">…</li>
        <?php endif; ?>
        <!-- Always show last page -->
        <?php if ($total_pages > 1) : ?>
          <?php $i_str = $total_pages < 10 ? '0' . $total_pages : $total_pages; ?>
          <li>
            <a href="<?php echo paginate_url($base_url, $total_pages, $term_param, $section_id); ?>" class="<?php echo $current_page == $total_pages ? 'active' : ''; ?>"><?php echo $i_str; ?></a>
          </li>
        <?php endif; ?>
        <!-- Next -->
        <li class="paginate__arrow paginate__arrow--right<?= $current_page == $total_pages ? ' disabled' : '' ?>">
          <a href="<?php echo paginate_url($base_url, $next_page, $term_param, $section_id); ?>">
            <?php get_template_part('template-parts/icons/icon-paginate'); ?>
          </a>
        </li>
      </ul>
    <?php endif; ?>
  </div>
</section>

<style>
  .paginate {
    --width: 49px;

    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1.2rem;
    margin: 0 auto;
    max-width: 900px;

    .paginate__arrow {
      display: flex;
      justify-content: center;
      align-items: center;
      width: var(--width);
      height: var(--width);
      border-radius: 50%;
      cursor: pointer;

      a {
        position: relative;
        background: var(--contrast);
        z-index: 2;
      }

      &.disabled {
        a {
          background: transparent;
          border: 1px solid var(--Blue-Grays-Lighter, #c0c8d2);
          opacity: 0.6 !important;
          cursor: not-allowed !important;
        }
      }

      svg {
        transform: rotate(180deg);
      }

      &--right {
        svg {
          position: relative;
          transform: rotate(0deg);
        }
      }
    }

    a {
      display: flex;
      justify-content: center;
      align-items: center;
      width: var(--width);
      height: var(--width);
      font-family: Manrope;
      font-size: 14px;
      font-weight: 400;
      line-height: normal;
      letter-spacing: 0.14px;
      text-align: center;
      color: var(--Blue-Graish-Darker, #5a6f8c);
      background: #e1e5ec;
      border-radius: 50%;
      transition: all 0.4s;
      overflow: hidden;
      font-style: normal;

      a:hover,
      &.active {
        color: white;
        background: var(--accent-solid);
        border-radius: 64px;
      }
    }

    @media screen and (max-width: 576px) {
      --width: 32px;
    }
  }
</style>
