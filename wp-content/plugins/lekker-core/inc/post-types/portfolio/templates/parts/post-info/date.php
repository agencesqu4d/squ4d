<div class="qodef-e qodef-info--date">
	<h5 class="qodef-e-title"><?php esc_html_e( 'Date: ', 'lekker-core' ); ?></h5>
	<p itemprop="dateCreated" class="entry-date updated"><?php the_time( get_option( 'date_format' ) ); ?></p>
	<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( get_the_ID() ); ?>"/>
</div>