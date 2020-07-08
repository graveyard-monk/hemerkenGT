<?php

	global $wp_version;

	if ( $wp_version >= 4.1 ) :

		the_posts_pagination( array( 'prev_text' => __( '&laquo; Previous', 'newsnow-pro' ), 'next_text' => __( 'Next &raquo;', 'newsnow-pro' ) ) );
	
	endif;

?>