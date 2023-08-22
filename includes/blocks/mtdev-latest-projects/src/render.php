<?php

$args = array(
  'post_type'        => 'mis-proyectos-web',
  'post_status'      => 'publish',
  'posts_per_page'   => $attributes['numberOfItems'],
  'order'            => $attributes['order'],
  'orderby'          => $attributes['orderBy'],
  'suppress_filters' => false,
);

if ( array_key_exists( 'category', $attributes ) && $attributes['category'] != -1 ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'mis_proyectos_web_category',
      'field'    => 'term_id',
      'terms'    => $attributes['category'],
    )
  );
}

$latest_posts = new WP_Query( $args );

?>
<section class="latest-projects-grid">
<?php
if ( $latest_posts->have_posts() ) {
  while ( $latest_posts->have_posts() ) {
    $latest_posts->the_post();
    ?>
    <article class="latest-projects-grid-item">

      <div class="latest-projects-grid-item__header">
        <div class="latest-projects-grid-item__thumbnail">
          <?php
            the_post_thumbnail();
          ?>
        </div>
      </div>

      <div class="latest-projects-grid-item__info">
        <?php
        $id = get_the_id();
        $primary_category_id = get_post_meta( $id, 'rank_math_primary_mis_proyectos_web_category', true );
        $category = get_term( $primary_category_id, 'mis_proyectos_web_category' );

        if ( !$category || is_wp_error( $category ) ) {
          $category = get_the_terms( $id, 'mis_proyectos_web_category' )[0];
        }

        echo '<ul class="latest-projects-grid-item__categories">';

        ?>
          <li class="latest-projects-grid-item__category">
            <?php echo esc_html( $category->name ); ?>
          </li>
        <?php

        echo '</ul>';
        ?>

        <h3 class="latest-projects-grid-item__title">
          <?php
            the_title();
          ?>
        </h3>

        <a href="<?php the_permalink(); ?>">
          Ver proyecto
        </a>
      </div>
    </article>
    <?php
  }
}
?>
</section>
<?php

wp_reset_postdata();
