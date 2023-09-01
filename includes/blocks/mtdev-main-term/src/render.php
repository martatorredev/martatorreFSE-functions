<?php

$post_type_term = array(
  'post' => 'category',
  'mis-proyectos-web' => 'mis_proyectos_web_category',
);

$post_id = $block->context['postId'];
$post_type = $block->context['postType'];

$term = $post_type_term[ $post_type ];
if ( ! $term ) $term = 'category';

$primary_term_id = get_post_meta( $post_id, "rank_math_primary_$term", true );

$post_term = null;

// Set $term var
if ( ! $primary_term_id ) {
  $terms = get_the_terms( $post_id, $term );

  if ( is_array ( $terms ) && ! empty( $terms ) ) {
    $post_term = $terms[0];
  }
} else {
  $post_term = get_term_by( 'id', $primary_term_id, $term );
}

$is_editor = !$post_id;

if ( $is_editor ) {
  // Simulate a default term
  $term = (object) array(
    'term_id' => 1,
    'name'    => 'Categoria principal',
  );
}

if ( $post_term ) {
  ?>
  <ul class="mtdev-post-terms">
    <li class="mtdev-post-term">
      <a href="<?php echo esc_url( get_category_link( $post_term->term_id ) ) ?>"><?php echo esc_html( $post_term->name ); ?></a>
    </li>
  </ul>
  <?php
}
