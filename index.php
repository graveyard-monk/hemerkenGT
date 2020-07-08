<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package HemerkenGT
 */

get_header();
?>

<div id="primary" class="content-area col-md-8 clear">

		<div id="home-welcome" class="clear">

		<div id="featured-content">

		<?php

			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 7,
				'meta_query' => array(
					array(
						'key'   => 'is_featured',
						'value' => 'true'
						)
					)				
				);

				// The Query
				$the_query = new WP_Query( $args );

				$i = 1;

			if ( $the_query->have_posts() && (!get_query_var('paged')) ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( $the_query->have_posts() ) :
				$the_query->the_post();

				

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );
		?>
				<?php
				$i++;
				endwhile;
			?>

				
	

		<main id="main" class="site-main clear">

<div id="recent-content">

<?php if ( is_active_sidebar( 'homepage' ) ) { ?>

	<?php dynamic_sidebar( 'homepage' ); ?>

<?php } else { ?>

	<div class="notice">
		<p><?php echo __('Put the "Home One/Two/Three Columns" widgets to the <strong>Homepage Content</strong> widget area.', 'hemerken-gt'); ?></p>
		<p><a href="<?php echo home_url(); ?>/wp-admin/widgets.php"><?php echo __('Okay, I\'m doing now &raquo;', 'newsnow-pro'); ?></a>  | <a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-home-widgets.png" target="_blank"><?php echo __('How To &raquo;', 'hemerken-gt'); ?></a></p>
	</div>

<?php } ?>							

</div><!-- #recent-content -->		

		</main><!-- #main -->

		</div><!-- #primary -->

<?php get_footer();
