<?php

// Add testimonials custom post type
function mtdev_testimonials_custom_post_type() {
	$labels = array(
		'name'               => 'Testimonios',
		'singular_name'      => 'Testimonio',
		'menu_name'          => 'Testimonios',
		'parent_item_colon'  => 'Testimonio padre',
		'all_items'          => 'Todos los Testimonios',
		'view_item'          => 'Ver Testimonio',
		'add_new_item'       => 'Añadir nuevo Testimonio',
		'add_new'            => 'Añadir nuevo',
		'edit_item'          => 'Editar Testimonio',
		'update_item'        => 'Actualizar Testimonio',
		'search_items'       => 'Buscar Testimonio',
		'not_found'          => 'No encontrado',
		'not_found_in_trash' => 'No encontrado en la papelera',
	);

	$args = array(
		'label'               => 'Testimonios',
		'description'         => 'Testimonios de Marta Torre',
		'labels'              => $labels,
		'supports'            => array(
			'title',
		),
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug' => 'testimonio',
		),
		'public'              => false,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-format-chat',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
	);

	// Registration of the custom post type
	register_post_type( 'testimonials', $args );
}

function mtdev_testimonials_custom_taxonomy() {
	$labels = array(
		'name'              => 'Categorías',
		'singular_name'     => 'Categoría',
		'search_items'      => 'Buscar categoría',
		'all_items'         => 'Todas las categoría',
		'parent_item'       => 'Categoría padre',
		'parent_item_colon' => 'Categoría padre:',
		'edit_item'         => 'Editar categoría',
		'update_item'       => 'Actualizar categoría',
		'add_new_item'      => 'Añadir nueva categoría',
		'new_item_name'     => 'Nombre de la nueva categoría',
		'menu_name'         => 'Categorías',
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
  );

	register_taxonomy(
		'testimonials_categories',
		array(
			'testimonials',
		),
		$args
	);
}

add_action( 'init', 'mtdev_testimonials_custom_post_type', 0 );
add_action( 'init', 'mtdev_testimonials_custom_taxonomy', 0 );

// Add Case Studies custom post type
function mtdev_case_studies_custom_post_type() {
	$labels = array(
		'name'               => 'Proyectos',
		'singular_name'      => 'Proyecto',
		'menu_name'          => 'Proyectos',
		'parent_item_colon'  => 'Proyecto padre',
		'all_items'          => 'Todos los proyectos',
		'view_item'          => 'Ver proyecto',
		'add_new_item'       => 'Añadir nuevo proyecto',
		'add_new'            => 'Añadir nuevo',
		'edit_item'          => 'Editar proyecto',
		'update_item'        => 'Actualizar proyecto',
		'search_items'       => 'Buscar proyecto',
		'not_found'          => 'No encontrado',
		'not_found_in_trash' => 'No encontrado en la papelera',
	);

	$args = array(
		'label'               => 'Proyectos',
		'description'         => 'Proyectos por Marta Torre',
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array(
			'case_studies_categories',
		),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-portfolio',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 2,
		'can_export'          => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'has_archive'         => 'mis-proyectos-web',
	);

	// Registration of the custom post type
	register_post_type( 'mis-proyectos-web', $args );
}

function mtdev_case_studies_custom_taxonomy() {
	$labels = array(
		'name'              => 'Categorias',
		'singular_name'     => 'Categoria',
		'search_items'      => 'Buscar categorias',
		'all_items'         => 'Todas las categorias',
		'parent_item'       => 'Categoria padre',
		'parent_item_colon' => 'Categoria padre:',
		'edit_item'         => 'Editar categoria',
		'update_item'       => 'Actualizar categoria',
		'add_new_item'      => 'Añadir nueva categoria',
		'new_item_name'     => 'Nombre de la nueva categoria',
		'menu_name'         => 'Categorías Proyectos',
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite' => array(
      'slug' => 'mis-proyectos-web-category',
    ),
	);
	register_taxonomy(
		'mis_proyectos_web_category',
		array(
			'mis-proyectos-web',
		),
		$args
	);
}

add_action( 'init', 'mtdev_case_studies_custom_post_type', 0 );
add_action( 'init', 'mtdev_case_studies_custom_taxonomy', 0 );


// Add Presentations custom post type
function mtdev_presentations_custom_post_type() {
	$labels = array(
		'name'               => 'Ponencias',
		'singular_name'      => 'Ponencia',
		'menu_name'          => 'Ponencias',
		'parent_item_colon'  => 'Ponencia padre',
		'all_items'          => 'Todas las ponencias',
		'view_item'          => 'Ver ponencia',
		'add_new_item'       => 'Añadir nueva ponencia',
		'add_new'            => 'Añadir nueva',
		'edit_item'          => 'Editar ponencia',
		'update_item'        => 'Actualizar ponencia',
		'search_items'       => 'Buscar ponencia',
		'not_found'          => 'No encontrada',
		'not_found_in_trash' => 'No encontrada en la papelera',
	);

	$args = array(
		'label'               => 'Ponencias',
		'description'         => 'Ponencias por Marta Torre',
		'labels'              => $labels,
		'supports'            => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
		),
		'taxonomies'          => array(
			'ponencias_categories',
		),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-admin-users',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 2,
		'can_export'          => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'capability_type'     => 'post',
		'show_in_rest'        => true,
		'has_archive'         => 'ponencias',
	);

	// Registration of the custom post type
	register_post_type( 'ponencias', $args );
}

function mtdev_presentations_custom_taxonomy() {
	$labels = array(
		'name'              => 'Categorias',
		'singular_name'     => 'Categoria',
		'search_items'      => 'Buscar categorias',
		'all_items'         => 'Todas las categorias',
		'parent_item'       => 'Categoria padre',
		'parent_item_colon' => 'Categoria padre:',
		'edit_item'         => 'Editar categoria',
		'update_item'       => 'Actualizar categoria',
		'add_new_item'      => 'Añadir nueva categoria',
		'new_item_name'     => 'Nombre de la nueva categoria',
		'menu_name'         => 'Categorías Ponencias',
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
		'rewrite' => array(
			'slug' => 'ponencias-category',
		),
	);
	register_taxonomy(
		'ponencias_category',
		array(
			'ponencias',
		),
		$args
	);
}

add_action( 'init', 'mtdev_presentations_custom_post_type', 0 );
add_action( 'init', 'mtdev_presentations_custom_taxonomy', 0 );

// Add Colaboradoras custom post type
function mtdev_colaboradoras_custom_post_type() {
	$labels = array(
		'name'               => 'Colaboradoras',
		'singular_name'      => 'Colaboradora',
		'menu_name'          => 'Colaboradoras',
		'parent_item_colon'  => 'Colaboradora padre',
		'all_items'          => 'Todas las colaboradoras',
		'view_item'          => 'Ver colaboradora',
		'add_new_item'       => 'Añadir nueva colaboradora',
		'add_new'            => 'Añadir nueva',
		'edit_item'          => 'Editar colaboradora',
		'update_item'        => 'Actualizar colaboradora',
		'search_items'       => 'Buscar colaboradora',
		'not_found'          => 'No encontrado',
		'not_found_in_trash' => 'No encontrado en la papelera',
	);

	$args = array(
		'label'               => 'Colaboradoras',
		'description'         => 'Colaboradoras de Marta Torre',
		'labels'              => $labels,
    'supports'            => array(
			'title',
		),
		'taxonomies'          => array(
			'colaboradoras_category',
		),
		'public'              => false,
		'show_ui'             => true,
		'menu_icon'           => 'dashicons-format-quote',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'capability_type'     => 'page',
		'show_in_rest'        => true,
	);

	// Registration of the custom post type
	register_post_type( 'colaboradoras', $args );
}

function mtdev_colaboradoras_custom_taxonomy() {
	$labels = array(
		'name'              => 'Categorías',
		'singular_name'     => 'Categoría',
		'search_items'      => 'Buscar categoría',
		'all_items'         => 'Todas las categoría',
		'parent_item'       => 'Categoría padre',
		'parent_item_colon' => 'Categoría padre:',
		'edit_item'         => 'Editar categoría',
		'update_item'       => 'Actualizar categoría',
		'add_new_item'      => 'Añadir nueva categoría',
		'new_item_name'     => 'Nombre de la nueva categoría',
		'menu_name'         => 'Categorías',
	);
	$args   = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
    'rewrite'           => array(
      'slug' => 'colaboradoras-category',
    ),
	);
	register_taxonomy(
		'colaboradoras_category',
		array(
			'colaboradoras',
		),
		$args
	);
}

add_action( 'init', 'mtdev_colaboradoras_custom_post_type', 0 );
add_action( 'init', 'mtdev_colaboradoras_custom_taxonomy', 0 );

function mtdev_custom_menu_order( $menu_ord ) {
	if ( ! $menu_ord ) {
		return true;
	}
	return array(
		'index.php',
		'edit.php',
		'edit.php?post_type=mis-proyectos-web',
		'edit.php?post_type=ponencias',
		'edit.php?post_type=testimonials',
		'edit.php?post_type=colaboradoras',
	);
}
add_filter( 'custom_menu_order', 'mtdev_custom_menu_order' );
add_filter( 'menu_order', 'mtdev_custom_menu_order' );
