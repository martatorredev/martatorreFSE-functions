<?php
/**
 * Plugin Name: Bloque de acordeon
 * Author:      EliezerSPP
 */

function mtdev_accordion_block_init() {
  register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_accordion_block_init' );
