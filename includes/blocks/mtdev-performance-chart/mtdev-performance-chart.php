<?php
/**
 * Plugin Name: Bloque de gráfica de rendimiento
 * Author:      EliezerSPP
 */

function mtdev_performance_chart_block_init() {
  register_block_type( __DIR__ . '/build' );
}

add_action( 'init', 'mtdev_performance_chart_block_init' );
