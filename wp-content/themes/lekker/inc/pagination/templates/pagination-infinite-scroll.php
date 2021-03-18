<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--infinite-scroll">
		<div class="qodef-infinite-scroll-spinner"></div>
	</div>
<?php } ?>