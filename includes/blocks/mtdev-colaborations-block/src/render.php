<?php
$args = array(
  'post_type'        => 'colaboradoras',
  'post_status'      => 'publish',
  'posts_per_page'   => $attributes['numberOfItems'],
  'order'            => $attributes['order'],
  'orderby'          => $attributes['orderBy'],
  'suppress_filters' => false,
);

if ( array_key_exists( 'category', $attributes ) && $attributes['category'] != -1 ) {
  $args['tax_query'] = array(
    array(
      'taxonomy' => 'colaboradoras_category',
      'field'    => 'term_id',
      'terms'    => $attributes['category'],
    )
  );
}

$colaborations = get_posts( $args );

$wrapper_attributes = get_block_wrapper_attributes();

?>
<section <?php echo $wrapper_attributes; ?>>
  <div class="colaborations__container">
    <?php
    foreach ( $colaborations as $colaboration ) {
      $id = $colaboration->ID;
      $name = get_field( 'position', $id );
      $url = get_field( 'url', $id );
      $logo_id = get_field( 'logo', $id );

      ?>
      <article class="colaboration">
        <?php
          if ($url) {
            printf(
              '<a class="colaboration__name" href="%s" target="_blank" rel="noopener">%s</a>',
              $url,
              $name
            );
          } else {
            printf(
              '<span class="colaboration__name">%s</span>',
              $name
            );
          }

          $logo_sizes  = wp_get_attachment_image_sizes( $logo_id );
          $logo_src    = wp_get_attachment_image_url( $logo_id, 'full' );
          $logo_srcset = wp_get_attachment_image_srcset( $logo_id, $logo_sizes );
          $logo_alt    = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );

          printf(
            '<img src="%s" srcset="%s" alt="%s" class="colaboration__logo" />',
            esc_url( $logo_src ),
            esc_attr($logo_srcset),
            esc_attr($logo_alt)
          );
        ?>
      </article>
      <?php
    }
    ?>
  </div>
</section>
<?php

wp_reset_postdata();
