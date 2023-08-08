<?php
/**
 * Plugin Name: Bloque de ultimos posts
 * Author:      EliezerSPP
 */



function mtdev_lastest_posts_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_lastest_posts_block_init' );

