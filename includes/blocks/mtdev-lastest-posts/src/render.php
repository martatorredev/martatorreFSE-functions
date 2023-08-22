<?php

$args = array(
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'posts_per_page'   => $attributes['postsToShow'],
  'order'            => $attributes['order'],
  'orderby'          => $attributes['orderBy'],
  'suppress_filters' => false,
);

if ( array_key_exists( 'category', $attributes ) && $attributes['category'] != -1 ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'category',
      'field'    => 'term_id',
      'terms'    => $attributes['category'],
    )
  );
}

$lastest_posts = new WP_Query( $args );

?>
<section class="lastest-posts-grid">
<?php
if ( $lastest_posts->have_posts() ) {
  while ( $lastest_posts->have_posts() ) {
    $lastest_posts->the_post();
    ?>
    <article class="lastest-posts-grid-item">

      <div class="lastest-posts-grid-item__header">
        <div class="lastest-posts-grid-item__thumbnail">
          <?php
            the_post_thumbnail();
          ?>
        </div>
      </div>

      <div class="lastest-posts-grid-item__info">
        <?php
        $primary_category_id = get_post_meta( '$post_id', 'rank_math_primary_category', true );
        $category = $primary_category_id
          ? get_term_by('id', $primary_category_id, 'category')
          : get_the_category()[0];

        echo '<ul class="lastest-posts-grid-item__categories">';

        ?>
          <li class="lastest-posts-grid-item__category">
            <?php echo esc_html( $category->name ); ?>
          </li>
        <?php

        echo '</ul>';
        ?>

        <time class="lastest-posts-grid-item__date"><?php the_date( 'd \d\e F \d\e Y')?></time>


        <h3 class="lastest-posts-grid-item__title">
          <?php
            the_title();
          ?>
        </h3>

        <div class="wp-block-buttons is-content-justification-center is-layout-flex">
          <div class="wp-block-button is-style-fill">
            <a class="wp-block-button__link has-white-color has-mt-dark-blue-background-color has-text-color has-background wp-element-button" href="<?php the_permalink(); ?>">
              Leer más
            </a>
          </div>
        </div>
      </div>
    </article>
    <?php
  }
}
?>
</section>
<?php

wp_reset_postdata();
