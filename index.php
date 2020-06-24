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

<div id="primary" class="content-area col-md-8">
	<main id="main" class="site-main">

		<?php

			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => get_theme_mod('latest-posts-num', '5')+1			
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

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
				<div class="notice">
					<p><?php echo __('Please edit posts and set "Featured Posts" for this section.', 'hemerken-gt'); ?></p>
					<p><a href="<?php echo home_url(); ?>/wp-admin/edit.php"><?php echo __('Okay, I\'m doing now &raquo;', 'hemerken-gt'); ?></a> | <a href="<?php echo get_template_directory_uri(); ?>/assets/img/how-to-featured.png" target="_blank"><?php echo __('How To &raquo;', 'hemerken-gt'); ?></a></p>
				</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<div class="col-md-4">
	<?php get_sidebar(); ?>
</div>
<?php get_footer();
