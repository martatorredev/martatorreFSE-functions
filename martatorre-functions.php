<?php
/**
 * Plugin Name: Martatorre Functions
 * Description: Este plugin contiene el registro de CPTs, bloques y custom fields.
 * Version:     1.0.0
 * Author:      Marta Torre
 */

defined( 'ABSPATH' ) || die( 'No script kiddies please!' );

// Plugin path and url
define( 'MTDEV_EXTRAS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'MTDEV_EXTRAS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// CPTs
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/cpts.php';

// Custom fields
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/custom-fields.php';

// Admin CSS
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/admin-css.php';

// Blocks
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/blocks/blocks.php';

// Head
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/head.php';

// Gravity Forms
require_once MTDEV_EXTRAS_PLUGIN_PATH . '/includes/gforms.php';
