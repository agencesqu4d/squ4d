<?php
$link_url_meta  = get_post_meta( get_the_ID(), 'qodef_post_format_link', true );
$link_url       = ! empty( $link_url_meta ) ? $link_url_meta : get_the_permalink();
$link_text_meta = get_post_meta( get_the_ID(), 'qodef_post_format_link_text', true );

if ( ! empty( $link_url ) ) {
	$link_text = ! empty( $link_text_meta ) ? $link_text_meta : get_the_title();
	$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h5';
	?>
	<div class="qodef-e-link">
	
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 577.55 577.55">
		<g data-name="Layer 2">
			<g id="Isolation_Mode" data-name="Isolation Mode">
				<path d="M245.53,245.53a26,26,0,0,1,36.75,0L332,295.27a9.19,9.19,0,0,0,13,0l49.73-49.74a9.17,9.17,0,0,0,0-13L345,182.82a114.7,114.7,0,0,0-162.19,0L33.6,332a114.66,114.66,0,0,0,0,162.19l49.74,49.73a114.63,114.63,0,0,0,162.18,0l84.09-84.08a9.18,9.18,0,0,0-6.49-15.67l-.61,0c-3,.2-6,.3-8.92.3a131.73,131.73,0,0,1-66.42-18A9.18,9.18,0,0,0,236.05,428l-53.24,53.23a26,26,0,0,1-36.75,0L96.32,431.49a26,26,0,0,1,0-36.75Z"/>
				<path d="M543.94,83.32,494.21,33.59a114.69,114.69,0,0,0-162.19,0l-84.08,84.12a9.18,9.18,0,0,0,6.48,15.67l.62,0c3-.21,6-.31,9-.31A130.8,130.8,0,0,1,330.32,151a9.16,9.16,0,0,0,11.14-1.42L394.74,96.3a26,26,0,0,1,36.75,0L481.22,146a26.06,26.06,0,0,1,0,36.77L332,332a26,26,0,0,1-36.77,0l-49.72-49.73a9.17,9.17,0,0,0-13,0L182.82,332a9.17,9.17,0,0,0,0,13l49.73,49.73a114.64,114.64,0,0,0,162.19,0l149.2-149.2a114.66,114.66,0,0,0,0-162.21Z"/>
			</g>
		</g>
	</svg>
	
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-link-text"><?php echo esc_html( $link_text ); ?>
	</<?php echo esc_attr( $title_tag ); ?>>
	<a itemprop="url" class="qodef-e-link-url" href="<?php echo esc_url( $link_url ); ?>" target="_blank"></a>
	</div>
<?php } ?>