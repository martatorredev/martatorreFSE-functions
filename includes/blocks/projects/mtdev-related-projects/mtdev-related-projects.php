<?php
/**
 * Plugin Name: Bloque de proyectos
 * Author:      Marta Torre
 */

function mtdev_related_projects_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_related_projects_block_init' );
