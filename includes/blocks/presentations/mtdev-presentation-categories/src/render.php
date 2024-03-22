<?php

$args = array(
  'taxonomy'     => 'ponencias_category',
  'echo'         => false,
  'hierarchical' => ! empty( $attributes['showHierarchy'] ),
  'orderby'      => 'name',
  'show_count'   => ! empty( $attributes['showPostCounts'] ),
  'title_li'     => '',
  'hide_empty'   => empty( $attributes['showEmpty'] ),
);
if ( ! empty( $attributes['showOnlyTopLevel'] ) && $attributes['showOnlyTopLevel'] ) {
  $args['parent'] = 0;
}

$wrapper_markup = '<ul %1$s>%2$s</ul>';
$items_markup   = wp_list_categories( $args );
$type           = 'list';

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => "mtdev-block-categories-{$type}" ) );

printf(
  $wrapper_markup,
  $wrapper_attributes,
  $items_markup
);
