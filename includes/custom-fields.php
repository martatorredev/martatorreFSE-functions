<?php

function mtdev_cta_field() {
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

add_action( 'acf/init', 'mtdev_cta_field' );

