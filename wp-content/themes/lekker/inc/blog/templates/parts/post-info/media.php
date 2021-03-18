<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			lekker_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			lekker_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			lekker_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			lekker_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
</div>