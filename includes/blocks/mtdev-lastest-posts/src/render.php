<?php

$args = array(
  'post_type'        => $attributes['postType'],
  'posts_per_page'   => $attributes['postsToShow'],
  'post_status'      => 'publish',
  'suppress_filters' => false,
);

if ( $attributes['postType'] === 'all' ) {
  $args['post_type'] = array( 'post', 'charlitas', 'colaboraciones' );
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
      <a class="lastest-posts-grid-item__link" href="<?php the_permalink(); ?>">Ir a la entrada</a>

      <div class="lastest-posts-grid-item__header">
        <div class="lastest-posts-grid-item__thumbnail">
          <?php
            the_post_thumbnail();
          ?>
        </div>
        <?php
        $category_tax = nd_get_category_tax( get_post_type() );
        $categories   = get_the_terms( get_the_ID(), $category_tax );

        if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
          echo '<ul class="lastest-posts-grid-item__categories">';

          if ( get_field( 'main_category' ) ) {
            ?>
              <li class="lastest-posts-grid-item__category">
                <?php echo esc_html( nd_get_main_category_name( get_the_ID() ) ); ?>
              </li>
            <?php

          } else {
            foreach ( $categories as $category ) {
              ?>
                <li class="lastest-posts-grid-item__category">
                  <?php echo esc_html( $category->name ); ?>
                </li>
              <?php
            }
          }

          echo '</ul>';
        }
        ?>
      </div>

      <div class="lastest-posts-grid-item__info">

        <?php
        $comments_count = wp_count_comments( get_the_ID() )->approved;

        if ( comments_open() || $comments_count > 0 ) {
          ?>
          <a class="lastest-posts-grid-item__comments-count" href="<?php echo esc_url( get_the_permalink() . '#comentarios' ); ?>">
            <img
              class="lastest-posts-grid-item__comments-icon"
              src="<?php echo esc_attr( ND_THEME_URL . '/assets/img/icon_comment.svg' ); ?>"
              alt="Icono de comentario"
            >
            <?php
              nd_comments_count_text( get_the_ID() );
            ?>
          </a>
          <?php
        }
        ?>

        <h3 class="lastest-posts-grid-item__title">
          <?php
            the_title();
          ?>
        </h3>

        <div class="lastest-posts-grid-item__excerpt">
          <?php
            the_excerpt();
          ?>
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
