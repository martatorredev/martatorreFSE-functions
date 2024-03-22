<?php
/**
 * Plugin Name: Bloque de Término Principal
 * Author:      Marta Torre
 */

function mtdev_main_term_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_main_term_block_init' );
