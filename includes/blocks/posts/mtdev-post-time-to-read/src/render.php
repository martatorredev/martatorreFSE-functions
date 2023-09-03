<?php
if ( ! isset( $block->context['postId'] ) ) {
  return '';
}

$content = get_the_content();

/*
  * Average reading rate - based on average taken from
  * https://irisreading.com/average-reading-speed-in-various-languages/
  * (Characters/minute used for Chinese rather than words).
  */
$average_reading_rate = 189;

$word_count_type = wp_get_word_count_type();

$minutes_to_read = max( 1, (int) round( wp_word_count( $content, $word_count_type ) / $average_reading_rate ) );

$minutes_to_read_string = sprintf(
  /* translators: %s is the number of minutes the post will take to read. */
  _n( '%s minute', '%s minutes', $minutes_to_read ),
  $minutes_to_read
);

$align_class_name = empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";

$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => $align_class_name ) );

printf(
  '<div %1$s>%2$s</div>',
  $wrapper_attributes,
  $minutes_to_read_string
);
