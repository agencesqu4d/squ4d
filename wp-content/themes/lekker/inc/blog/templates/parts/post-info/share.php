<?php if ( class_exists( 'LekkerCoreSocialShareShortcode' ) ) { ?>
	<?php
	$params              = array();
	$params['layout']    = 'list';
	$params['title']     = 'Share: ';
	$params['icon_font'] = 'elegant-icons';
	
	echo LekkerCoreSocialShareShortcode::call_shortcode( $params ); ?>
<?php } ?>