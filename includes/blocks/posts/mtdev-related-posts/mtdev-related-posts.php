<?php
/**
 * Plugin Name: Bloque de posts relacionados
 * Author:      EliezerSPP
 */

function mtdev_related_posts_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_related_posts_block_init' );
