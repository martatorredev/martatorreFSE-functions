<?php
/**
 * Plugin Name: Bloque de proyectos
 * Author:      EliezerSPP
 */

function mtdev_latest_projects_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_latest_projects_block_init' );

if( ! function_exists( 'mtdev_get_var' ) ) {
  function mtdev_get_var ($key, $default = null) {
    return isset( $_GET[$key] ) ? sanitize_text_field( $_GET[$key] ) : $default;
  }
}

// Require rest api route
require_once __DIR__ . '/rest-api.php';
