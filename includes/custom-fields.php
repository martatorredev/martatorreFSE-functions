<?php

function mtdev_testimonial_fields() {
  acf_add_local_field_group(array(
    'key' => 'group_testimonial',
    'title' => 'Opciones de testimonios',
    'fields' => array(
      array(
        'key' => 'field_testimonial_author_image',
        'label' => 'Imagen del autor',
        'name' => 'author_image',
        'type' => 'image',
        'required' => false,
        'return_format' => 'url',
        'preview_size' => 'medium',
        'library' => 'all',
      ),
      array(
        'key' => 'field_author_subtitle',
        'label' => 'Subtitulo del testimonio',
        'name' => 'author_subtitle',
        'type' => 'wysiwyg',
        'instructions' => '(Ej. Cargo del autor)',
        'required' => true,
        'tabs' => 'visual',
        'media_upload' => false,
        'toolbar' => 'basic',
      ),
      array(
        'key' => 'field_content',
        'label' => 'Contenido del testimonio',
        'name' => 'content',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => true,
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => false,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'testimonials',
        ),
      ),
    ),
  ));
}

add_action( 'acf/init', 'mtdev_testimonial_fields' );

function mtdev_project_fields() {
  acf_add_local_field_group(array(
    'key' => 'group_project',
    'title' => 'Opciones de proyectos',
    'fields' => array(
      array(
        'key' => 'field_project_client',
        'label' => 'Cliente',
        'name' => 'cliente',
        'type' => 'text',
      ),
      array(
        'key' => 'field_project_client_url',
        'label' => 'URL del Cliente',
        'name' => 'url_cliente',
        'type' => 'url',
      ),
      array(
        'key' => 'field_project_type',
        'label' => 'Tipo de proyecto',
        'name' => 'tipo_de_proyecto',
        'type' => 'textarea',
      ),
      array(
        'key' => 'field_project_collaborators',
        'label' => 'Equipo',
        'name' => 'profesionales',
        'type' => 'repeater',
        'layout' => 'table',
        'button_label' => 'Agregar Fila',
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_collaborator_name',
            'label' => 'Nombre',
            'name' => 'nombre',
            'type' => 'text',
            'required' => true,
            'parent_repeater' => 'field_project_collaborators',
          ),
          array(
            'key' => 'field_collaborator_url',
            'label' => 'URL',
            'name' => 'url',
            'type' => 'url',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_collaborator_name',
                  'operator' => '!=empty',
                ),
              ),
            ),
            'parent_repeater' => 'field_project_collaborators',
          ),
        ),
      ),
      array(
        'key' => 'field_project_services',
        'label' => 'Servicios',
        'name' => 'services',
        'type' => 'repeater',
        'layout' => 'table',
        'button_label' => 'Agregar Fila',
        'rows_per_page' => 20,
        'sub_fields' => array(
          array(
            'key' => 'field_service_name',
            'label' => 'Nombre',
            'name' => 'nombre',
            'type' => 'text',
            'required' => true,
            'parent_repeater' => 'field_project_services',
          ),
          array(
            'key' => 'field_service_url',
            'label' => 'URL',
            'name' => 'url',
            'type' => 'url',
            'conditional_logic' => array(
              array(
                array(
                  'field' => 'field_service_name',
                  'operator' => '!=empty',
                ),
              ),
            ),
            'parent_repeater' => 'field_project_services',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'mis-proyectos-web',
        ),
      ),
    ),
    'style' => 'seamless',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_rest' => false,
  ));
}

add_action( 'acf/init', 'mtdev_project_fields' );

function mtdev_colaborations_fields() {
	acf_add_local_field_group(array(
    'key' => 'group_colaborations',
    'title' => 'Opciones',
    'fields' => array(
      array(
        'key' => 'field_colaboration_position',
        'label' => 'Cargo',
        'name' => 'position',
        'type' => 'text',
        'required' => true,
      ),
      array(
        'key' => 'field_colaboration_url',
        'label' => 'URL',
        'name' => 'url',
        'type' => 'url',
        'required' => false,
      ),
      array(
        'key' => 'field_colaboration_logo',
        'label' => 'Logo',
        'name' => 'logo',
        'type' => 'image',
        'required' => true,
        'return_format' => 'id',
        'library' => 'all',
        'preview_size' => 'medium',
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'colaboradoras',
        ),
      ),
    ),
    'menu_order' => -INF,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_rest' => false,
  ));
}

add_action( 'acf/init', 'mtdev_colaborations_fields' );

function mtdev_presentations_fields() {
	acf_add_local_field_group(array(
    'key' => 'group_presentations',
    'title' => 'Opciones',
    'fields' => array(
      array(
        'key' => 'field_presentation_event',
        'label' => 'Evento',
        'name' => 'evento',
        'type' => 'text',
      ),
      array(
        'key' => 'field_presentation_video',
        'label' => 'Video',
        'name' => 'video',
        'type' => 'oembed',
        'required' => false,
      ),
      array(
        'key' => 'field_presentation_url',
        'label' => 'Slide URL',
        'name' => 'slide_url',
        'type' => 'url',
        'required' => false,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'ponencias',
        ),
      ),
    ),
    'menu_order' => -INF,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_rest' => false,
  ));
}

add_action( 'acf/init', 'mtdev_presentations_fields' );
