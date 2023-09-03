<?php
/**
 * Plugin Name: Bloque de categorias proyectos
 * Author:      EliezerSPP
 */

function mtdev_post_time_to_read_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_post_time_to_read_block_init' );

function mtdev_word_count( $text, $type, $settings = array() ) {
  $defaults = array(
    'html_regexp'                        => '/<\/?[a-z][^>]*?>/i',
    'html_comment_regexp'                => '/<!--[\s\S]*?-->/',
    'space_regexp'                       => '/&nbsp;|&#160;/i',
    'html_entity_regexp'                 => '/&\S+?;/',
    'connector_regexp'                   => "/--|\x{2014}/u",
    'remove_regexp'                      => "/[\x{0021}-\x{0040}\x{005B}-\x{0060}\x{007B}-\x{007E}\x{0080}-\x{00BF}\x{00D7}\x{00F7}\x{2000}-\x{2BFF}\x{2E00}-\x{2E7F}]/u",
    'astral_regexp'                      => "/[\x{010000}-\x{10FFFF}]/u",
    'words_regexp'                       => '/\S\s+/u',
    'characters_excluding_spaces_regexp' => '/\S/u',
    'characters_including_spaces_regexp' => "/[^\f\n\r\t\v\x{00AD}\x{2028}\x{2029}]/u",
    'shortcodes'                         => array(),
  );

  $count = 0;

  if ( ! $text ) {
    return $count;
  }

  $settings = wp_parse_args( $settings, $defaults );

  // If there are any shortcodes, add this as a shortcode regular expression.
  if ( is_array( $settings['shortcodes'] ) && ! empty( $settings['shortcodes'] ) ) {
    $settings['shortcodes_regexp'] = '/\\[\\/?(?:' . implode( '|', $settings['shortcodes'] ) . ')[^\\]]*?\\]/';
  }

  // Sanitize type to one of three possibilities: 'words', 'characters_excluding_spaces' or 'characters_including_spaces'.
  if ( 'characters_excluding_spaces' !== $type && 'characters_including_spaces' !== $type ) {
    $type = 'words';
  }

  $text .= "\n";

  // Replace all HTML with a new-line.
  $text = preg_replace( $settings['html_regexp'], "\n", $text );

  // Remove all HTML comments.
  $text = preg_replace( $settings['html_comment_regexp'], '', $text );

  // If a shortcode regular expression has been provided use it to remove shortcodes.
  if ( ! empty( $settings['shortcodes_regexp'] ) ) {
    $text = preg_replace( $settings['shortcodes_regexp'], "\n", $text );
  }

  // Normalize non-breaking space to a normal space.
  $text = preg_replace( $settings['space_regexp'], ' ', $text );

  if ( 'words' === $type ) {
    // Remove HTML Entities.
    $text = preg_replace( $settings['html_entity_regexp'], '', $text );

    // Convert connectors to spaces to count attached text as words.
    $text = preg_replace( $settings['connector_regexp'], ' ', $text );

    // Remove unwanted characters.
    $text = preg_replace( $settings['remove_regexp'], '', $text );
  } else {
    // Convert HTML Entities to "a".
    $text = preg_replace( $settings['html_entity_regexp'], 'a', $text );

    // Remove surrogate points.
    $text = preg_replace( $settings['astral_regexp'], 'a', $text );
  }

  // Match with the selected type regular expression to count the items.
  preg_match_all( $settings[ $type . '_regexp' ], $text, $matches );

  if ( $matches ) {
    return count( $matches[0] );
  }

  return $count;
}
