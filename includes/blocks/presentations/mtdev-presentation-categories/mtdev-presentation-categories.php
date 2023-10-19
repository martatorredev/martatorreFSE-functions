<?php
/**
 * Plugin Name: Bloque de categorias de ponencias
 * Author:      EliezerSPP
 */

function mtdev_presentations_categories_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_presentations_categories_block_init' );
