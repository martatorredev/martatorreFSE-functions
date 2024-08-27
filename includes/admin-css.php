<?php

add_action('admin_head', 'mtdev_admin_styles');
function mtdev_admin_styles() {
	?>
	<style>
    .acf-field-author-subtitle iframe {
      height: 3.5em !important;
      min-height: 3.5em;
    }
	</style>
	<?php
}
