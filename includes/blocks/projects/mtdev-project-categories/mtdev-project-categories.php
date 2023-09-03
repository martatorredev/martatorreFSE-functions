<?php
/**
 * Plugin Name: Bloque de categorias proyectos
 * Author:      EliezerSPP
 */

function mtdev_project_categories_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_project_categories_block_init' );
