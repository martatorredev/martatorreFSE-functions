<?php
/**
 * Plugin Name: Bloque de ponencias
 * Author:      EliezerSPP
 */

function mtdev_related_presentations_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_related_presentations_block_init' );
