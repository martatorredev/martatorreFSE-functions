<?php
/**
 * Plugin Name: Bloque de ultimos proyectos
 * Author:      EliezerSPP
 */



function mtdev_lastest_projects_block_init() {
	register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_lastest_projects_block_init' );

