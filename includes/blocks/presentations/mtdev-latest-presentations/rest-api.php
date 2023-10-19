<?php

add_action( 'rest_api_init', function () {
  register_rest_route( 'mtdev', '/get_presentations', array(
    'methods'             => 'GET',
    'callback'            => 'mtdev_get_presentations',
    'show_in_index'       => false,
    'permission_callback' => '__return_true',
  ));
} );

function mtdev_get_presentations ( $request ) {
  $params = $request->get_params();
  $attributes = $params;

  ob_start();
  require __DIR__ . '/build/render.php';
  return ob_get_clean();
}
