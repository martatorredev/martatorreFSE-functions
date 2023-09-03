<?php
/**
 * Plugin Name: Bloque de categorias proyectos
 * Author:      EliezerSPP
 */

function mtdev_post_time_to_read_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_post_time_to_read_block_init' );
