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
        'key' => 'field_project_type',
        'label' => 'Tipo de proyecto',
        'name' => 'tipo_de_proyecto',
        'type' => 'textarea',
      ),
      array(
        'key' => 'field_project_collaborators',
        'label' => 'Profesionales',
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
            'label' => 'Url',
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
        'key' => '=field_project_services',
        'label' => 'Servicios',
        'name' => 'servicios',
        'type' => 'post_object',
        'post_type' => array(
          0 => 'page',
        ),
        'post_status' => array(
          0 => 'publish',
        ),
        'return_format' => 'object',
        'multiple' => true,
        'ui' => true,
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
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_rest' => 0,
  ));
}

add_action( 'acf/init', 'mtdev_project_fields' );

