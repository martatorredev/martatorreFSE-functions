<?php
  $wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'entry-content' ) );
  $slide_url = get_field( 'slide_url' );
?>
<div <?php echo $wrapper_attributes ?>>
  <div class="embed-container">
    <?php the_field( 'video' ); ?>
  </div>

  <?php
    if ( $slide_url ) {
      printf(
        '<p>Slides: <a href="%s" target="_blank">%s</a></p>',
        esc_url( $slide_url ),
        esc_html( $slide_url )
      );
    }
  ?>
</div>
<?php
