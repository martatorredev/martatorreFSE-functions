<?php

/**
 * Plugin Name: Bloque de Hero Banner
 */

function mtdev_banner_block_init() {
	register_block_type_from_metadata(__DIR__);
}

add_action( 'init', 'mtdev_banner_block_init' );
