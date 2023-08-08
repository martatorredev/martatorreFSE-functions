<?php
$args = array(
  'post_type'        => 'testimonials',
  'post_status'      => 'publish',
  'posts_per_page'   => $attributes['postsToShow'],
  'order'            => $attributes['order'],
  'orderby'          => $attributes['orderBy'],
  'suppress_filters' => false,
);

if ( array_key_exists( 'category', $attributes ) && $attributes['category'] != -1 ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'testimonials_categories',
      'field'    => 'term_id',
      'terms'    => $attributes['category'],
    )
  );
}

if ( $attributes['selectRandomTestimonials'] ) {
  $args['orderby'] = 'rand';
}


$testimonials = get_posts( $args );

$classes = array('testimonials', count($testimonials) > 1 ? 'testimonials--multiple' : 'testimonials--single');

$wrapper_attributes = get_block_wrapper_attributes(
  array(
    'class'       => join( ' ', $classes ),
    'data-random' => $attributes['selectRandomTestimonials']
  )
);

?>
<section <?php echo $wrapper_attributes; ?>>
  <div class="testimonials__container">
    <?php
    foreach ( $testimonials as $testimonial ) {
      $id = $testimonial->ID;
      $author_name = $testimonial->post_title;
      $author_subtitle = get_field( 'author_subtitle', $id );
      $img_url = get_field( 'author_image', $id );
      $content = get_field( 'content', $id );

      ?>
      <article class="testimonial" data-id="<?php echo $id; ?>">
        <div class="testimonial__content">
          <?php echo $content; ?>
        </div>

        <div class="testimonial-author">
          <?php
            if ($img_url) {
              ?>
              <img class="testimonial-author__image" src="<?php echo $img_url; ?>" alt="Imagen del autor del testimonio">
              <?php
            } else {
              ?>
              <div class="testimonial-author__placeholder"></div>
              <?php
            }
          ?>

          <div class="testimonial-author__info">
            <p class="testimonial-author__name">
              <?php echo $author_name; ?>
            </p>

            <?php
              if ($author_subtitle) {
                ?>
                <p class="testimonial-author__subtitle">
                  <?php echo $author_subtitle; ?>
                </p>
                <?php
              }
            ?>
          </div>
        </div>
      </article>
      <?php
    }
    ?>
  </div>
</section>
<?php

wp_reset_postdata();
