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
      $name = $colaboration->post_title;
      $url = get_field( 'url', $id );
      $logo_url = get_field( 'logo', $id );

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
        ?>
        <img class="colaboration__logo" src="<?php echo $logo_url; ?>" alt="Imagen del autor del testimonio">
      </article>
      <?php
    }
    ?>
  </div>
</section>
<?php

wp_reset_postdata();
