<?php
/**
 * Plugin Name: Bloque de testimonios
 * Author:      EliezerSPP
 */

function mtdev_testimonials_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_testimonials_block_init' );
