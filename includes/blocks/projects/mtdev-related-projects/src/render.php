<?php

$category_tax = 'mis_proyectos_web_category';

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
  echo '<section class="mtdev-related-projects">';

  while ( $related->have_posts() ) {
    $related->the_post();
    ?>
    <article class="mtdev-related-projects-item">
      <a class="mtdev-related-projects-item__link" href="<?php the_permalink(); ?>">Ver proyecto</a>

      <div class="mtdev-related-projects-item__header">
        <div class="mtdev-related-projects-item__thumbnail">
          <?php
            the_post_thumbnail();
          ?>
        </div>
      </div>

      <div class="mtdev-related-projects-item__info">
        <?php
        $id = get_the_id();
        $primary_category_id = get_post_meta( $id, 'rank_math_primary_mis_proyectos_web_category', true );
        $post_category = get_term( $primary_category_id, 'mis_proyectos_web_category' );

        if ( !$post_category || is_wp_error( $post_category ) ) {
          $categories = get_the_terms( $id, 'mis_proyectos_web_category' );

          if ( ! empty( $categories ) ) {
            $post_category = $categories[0];
          }
        }

        if ( $post_category ) {
          ?>
          <ul class="mtdev-related-projects-item__categories">
            <li class="mtdev-related-projects-item__category">
              <a href="<?php
                echo esc_url( get_category_link( $post_category->term_id ) );
              ?>"><?php echo esc_html( $post_category->name ); ?></a>
            </li>
          </ul>
          <?php
        }

        ?>

        <h3 class="mtdev-related-projects-item__title">
          <?php the_title(); ?>
        </h3>

        <a class="mtdev-related-projects-item__button" href="<?php the_permalink(); ?>">
          Ver proyecto
        </a>
      </div>
    </article>
    <?php
  }
  echo '</section>';
} else {
  echo '<p>No hay proyectos relacionados</p>';
}


wp_reset_postdata();
