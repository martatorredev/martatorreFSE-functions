<?php

if ( class_exists( 'GFForms' ) ) {
	class MT_Field_Section extends GF_Field_Section {
		public function get_field_content( $value, $force_frontend_label, $form ) {
			$field_label = $this->get_field_label( $force_frontend_label, $value );

			$admin_buttons = $this->get_admin_buttons();

			$admin_hidden_markup = ( $this->visibility == 'hidden' ) ? $this->get_hidden_admin_markup() : '';

			$description = $this->get_description( $this->description, 'gsection_description' );
			$tag         = GFCommon::is_legacy_markup_enabled( $form ) ? 'h2' : 'h3';

			// ! THIS IS THE UNIQUE CHANGE TO BE ALWAYS AN H2
			if ( $form['title'] == 'Presupuesto' ) {
				$tag = 'h2';
			}
			/* translators: 1. Admin buttons markup 2. Heading tag 3. The field label 4. The description */
			$field_content = sprintf( '%1$s%2$s<%3$s class="gsection_title">%4$s</%3$s>%5$s', $admin_buttons, $admin_hidden_markup, $tag, esc_html( $field_label ), $description );

			return $field_content;
		}
	}

	function mt_override_gf_field_section( $field, $properties ) {
		if ( $field->type == 'section' ) {
			$field = new MT_Field_Section( $properties );
		}

		return $field;
	}

	add_filter( 'gform_gf_field_create', 'mt_override_gf_field_section', 10, 2 );
}
