<?php
/**
 * Plugin Name: Bloque de colaboraciones
 * Author:      EliezerSPP
 */

function mtdev_colaborations_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_colaborations_block_init' );
