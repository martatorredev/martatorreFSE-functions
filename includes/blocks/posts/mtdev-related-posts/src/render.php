<?php

$category_tax = 'category';

$terms = get_the_terms( get_the_ID(), $category_tax );

if ( ! $terms ) {
  $terms = get_terms( $category_tax );
}

$term_ids = wp_list_pluck( $terms, 'term_id' );

$related = new WP_Query(
  array(
    'post_type'      => get_post_type(),
    'posts_per_page' => 2,
    'post__not_in'   => array( get_the_ID() ),
    'orderby'        => 'rand',
    'tax_query'      => array(
      array(
        'taxonomy' => $category_tax,
        'field' => 'term_id',
        'terms' => $term_ids,
      )
    ),
  )
);

if ( $related->have_posts() ) {
  echo '<section class="mtdev-related-posts">';

  while ( $related->have_posts() ) {
    $related->the_post();
    ?>
    <article class="mtdev-related-posts-item">
      <a class="mtdev-related-posts-item__link" href="<?php the_permalink(); ?>">Ir a la entrada</a>

      <div class="mtdev-related-posts-item__header">
        <div class="mtdev-related-posts-item__thumbnail">
          <?php
            if ( has_post_thumbnail() ) {
              echo get_the_post_thumbnail();
            } else {
              ?>
              <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/placeholder.png' ); ?>" alt="Placeholder">
              <?php
            }
          ?>
        </div>
      </div>

      <div class="mtdev-related-posts-item__info">
        <?php
        $primary_category_id = get_post_meta( '$post_id', 'rank_math_primary_category', true );
        $post_category = $primary_category_id
          ? get_term_by('id', $primary_category_id, 'category')
          : get_the_category();

        if ( is_array ( $post_category ) && ! empty( $post_category ) ) $post_category = $post_category[0];

        if ( $post_category ) {
          ?>
          <ul class="mtdev-related-posts-item__categories">
            <li class="mtdev-related-posts-item__category">
              <a
                class="mtdev-related-posts-item__category-link"
                href="<?php
                  echo esc_url( get_category_link( $post_category->term_id ) );
                ?>"
              ><?php echo esc_html( $post_category->name ); ?></a>
            </li>
          </ul>
          <?php
        }
        ?>

        <time class="mtdev-related-posts-item__date"><?php the_date( 'd \d\e F \d\e Y')?></time>

        <h3 class="mtdev-related-posts-item__title">
          <a class="mtdev-related-posts-item__title-link" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h3>
      </div>
    </article>
    <?php
  }
  echo '</section>';
} else {
  echo '<p>No hay posts relacionados</p>';
}


wp_reset_postdata();
