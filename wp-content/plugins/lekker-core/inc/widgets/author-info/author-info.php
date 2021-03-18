<?php

if ( ! function_exists( 'lekker_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param $widgets array
	 *
	 * @return array
	 */
	function lekker_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'LekkerCoreAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'lekker_core_filter_register_widgets', 'lekker_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class LekkerCoreAuthorInfoWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'lekker_core_author_info' );
			$this->set_name( esc_html__( 'Lekker Author Info', 'lekker-core' ) );
			$this->set_description( esc_html__( 'Add author info element into widget areas', 'lekker-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_username',
					'title'      => esc_html__( 'Author Username', 'lekker-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'color',
					'name'       => 'author_color',
					'title'      => esc_html__( 'Author Color', 'lekker-core' )
				)
			);
			$this->set_widget_option(
				array(
					'field_type' => 'iconpack',
					'name'       => 'icon_pack_author',
					'title'      => esc_html__( 'Author Icon', 'lekker-core' )
				)
			);
		}
		
		public function render( $atts ) {
			$author_id = 1;
			if ( ! empty( $atts['author_username'] ) ) {
				$author = get_user_by( 'login', $atts['author_username'] );
				
				if ( ! empty( $author ) ) {
					$author_id = $author->ID;
				}
			}
			
			$author_link = get_author_posts_url( $author_id );
			$author_bio  = get_the_author_meta( 'description', $author_id );
			?>
			<div class="widget qodef-author-info">
				<a itemprop="url" class="qodef-author-info-image" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 210 ); ?>
				</a>
				<?php if ( ! empty( $author_bio ) ) { ?>
					<h5 class="qodef-author-info-name vcard author">
						<span class="fn">
							<?php esc_html_e( 'Well hello there, I’m', 'lekker-core' ); ?>
							<br/>
							<?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?>
						</span>
					</h5>
					<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
						<p itemprop="description" class="qodef-author-info-description">
							<?php esc_html_e( 'About Me', 'lekker-core' ); ?>
						</p>
					</a>
				<?php } ?>
			</div>
			<?php
		}
	}
}
