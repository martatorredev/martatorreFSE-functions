<?php

$post_type_term = array(
  'post' => 'category',
  'mis-proyectos-web' => 'mis_proyectos_web_category',
  'ponencias' => 'ponencias_category',
);

$post_id = $block->context['postId'];
$post_type = $block->context['postType'];

$term = $post_type_term[ $post_type ];
if ( ! $term ) $term = 'category';

$primary_term_id = get_post_meta( $post_id, "rank_math_primary_$term", true );

$post_term = null;

// Set $term var
if ( ! $primary_term_id ) {
  $post_terms = get_the_terms( $post_id, $term );

  if ( is_array ( $post_terms ) && ! empty( $post_terms ) ) {
    $post_term = $post_terms[0];
  }
} else {
  $post_term = get_term_by( 'id', $primary_term_id, $term );
}

$is_editor = !$post_id;

if ( $is_editor ) {
  // Simulate a default term
  $post_term = (object) array(
    'term_id' => 1,
    'name'    => 'Categoria principal',
  );
}

if ( $post_term ) {
  ?>
  <ul class="mtdev-post-terms">
    <li class="mtdev-post-term">
      <?php
        if ($attributes['withLink']) {
          printf(
            '<a class="mtdev-post-term__link" href="%s">%s</a>',
            esc_url( get_category_link( $post_term->term_id ) ),
            esc_html( $post_term->name )
          );
        } else {
          echo $post_term->name;
        }
      ?>
    </li>
  </ul>
  <?php
}
