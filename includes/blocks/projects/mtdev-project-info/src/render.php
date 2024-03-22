<?php

$wrapper_attributes = get_block_wrapper_attributes();
?>
<section <?php echo $wrapper_attributes ?>>
	<div class="project-info">
	<?php
	// Display client information.
	$client = get_field( 'cliente' );
  $client_url = get_field( 'url_cliente' );

	if ( $client ) {
    ?><h4 class="project-info__title">Cliente</h4><?php

    $client_markup = '<p class="project-info__text">%s</p>';

    if ( ! $client_url ) {
			printf(
				$client_markup,
				esc_html( $client )
			);
    } else {
			printf(
				$client_markup,
				'<a href="' . esc_url( $client_url ) . '" target="_blank">' . esc_html( $client ) . '</a>'
			);
		}
	}

	// Display project type information.
	$project_type = get_field( 'tipo_de_proyecto' );
	if ( $project_type ) {
    ?>
    <h4 class="project-info__title">Tipo de proyecto</h4>
    <p class="project-info__text">
      <?php echo esc_html( $project_type ); ?>
    </p>
    <?php
	}

	// Display collaborators.
	mtdev_display_repeater_field( 'Profesionales', 'profesionales', 'project-info__list' );

	// Display services.
	mtdev_display_repeater_field( 'Servicios', 'services', 'project-info__list' );
	?>
	</div>
</section>
<?php

/**
 * The function `mtdev_display_repeater_field` displays a list of items with names and optional URLs in
 * a specified format.
 *
 * @param string $title      The title parameter is a string that represents the title of the repeater field. It will be displayed as a heading above the list of items.
 * @param string $field_name The field name is a string that represents the name of the repeater field in the WordPress database. It is used to retrieve the data stored in the repeater field.
 * @param string $classname  The classname parameter is used to specify the CSS class for the <ul> element in the HTML output.
 *
 * @return void if there are no rows in the repeater field.
 */
function mtdev_display_repeater_field( $title, $field_name, $classname ) {
	$rows = get_field( $field_name );
	if ( ! $rows ) {
		return;
	}

	?>
	<h4 class="project-info__title"><?php echo esc_html( $title ); ?></h4>
	<ul class="<?php echo esc_attr( $classname ); ?>">
		<?php
		foreach ( $rows as $row ) {
			$name = $row['nombre'];
			$url  = $row['url'];

			if ( ! $name ) {
				continue;
			}

			$item = '<li>%s</li>';

			if ( $url ) {
				$item = sprintf( $item, '<a href="' . esc_url( $url ) . '" target="_blank">%s</a>' );
			}
			printf( $item, esc_html( $name ) );
		}
		?>
	</ul>
	<?php
}
