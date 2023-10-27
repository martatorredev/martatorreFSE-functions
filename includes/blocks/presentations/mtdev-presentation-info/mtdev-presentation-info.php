<?php
/**
 * Plugin Name: Bloque de informacion de la ponencia
 * Author:      EliezerSPP
 */

function mtdev_presentation_info_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_presentation_info_block_init' );
