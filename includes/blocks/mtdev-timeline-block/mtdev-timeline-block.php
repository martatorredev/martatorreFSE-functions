<?php
/**
 * Plugin Name: Bloque de timeline
 * Author:      EliezerSPP
 */

function mtdev_timeline_block_init() {
  register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_timeline_block_init' );
