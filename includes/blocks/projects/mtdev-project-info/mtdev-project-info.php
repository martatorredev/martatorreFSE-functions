<?php
/**
 * Plugin Name: Bloque de informacion del proyecto
 * Author:      Marta Torre
 */

function mtdev_project_info_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_project_info_block_init' );
