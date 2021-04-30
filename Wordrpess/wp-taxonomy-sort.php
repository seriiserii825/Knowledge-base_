                <?php
                $terms = get_terms([
                    'taxonomy' => $current_term->taxonomy,
                    'parent' => $current_term->term_id,
                    'hide_empty' => false
                ]); ?>

                <?php foreach ($terms as $term) : ?>
                    <?php $term->sort_number = +get_field('taxonomy', $term)['sort_number']; ?>
                <?php endforeach; ?>

                <?php
                usort($terms, function ($a, $b) {
                    return $a->sort_number <=> $b->sort_number;
                });
                ?>
