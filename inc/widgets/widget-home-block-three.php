<?php
/**
 * Three Columns widget.
 *
 * @package    hemerken_gt
 * @author     GoblinThemes
 * @copyright  Copyright (c) 2017, GoblinThemes
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class hemerken_gt_Block_Three_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-hemerken_gt-home-three-columns',
			'description' => __( 'Display three-column post blocks. Only use for the "Homepage Content" widget area.', 'hemerken-gt' )
		);

		// Create the widget.
		parent::__construct(
			'goblin-home-three-columns',         // $this->id_base
			__( '&raquo; Home Three Columns', 'hemerken-gt' ), // $this->name
			$widget_options                    // $this->widget_options
		);
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

			echo '<div class="content-block content-block-3 clear">';

				hemerken_gt_home_posts_left_col( $args, $instance );

				hemerken_gt_home_posts_middle_col( $args, $instance );

				hemerken_gt_home_posts_right_col( $args, $instance );				

			echo '</div><!-- .content-block-3 -->';

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;

		$instance['limit']   = (int) $new_instance['limit'];
		$instance['cat']     = $new_instance['cat'];
		$instance['cat_2']   = $new_instance['cat_2'];
		$instance['cat_3']   = $new_instance['cat_3'];		

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'limit'   => 4,
			'cat'     => '',
			'cat_2'   => '',
			'cat_3'   => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Choose category for column #1', 'hemerken-gt' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<option value="0"><?php _e( 'All categories &hellip;', 'hemerken-gt' ); ?></option>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo esc_attr( $category->term_id ); ?>" <?php selected( $instance['cat'], $category->term_id ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat_2' ); ?>"><?php _e( 'Choose category for column #2', 'hemerken-gt' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat_2' ); ?>" name="<?php echo $this->get_field_name( 'cat_2' ); ?>" style="width:100%;">
				<?php $categories_2 = get_terms( 'category' ); ?>
				<option value="0"><?php _e( 'All categories &hellip;', 'hemerken-gt' ); ?></option>
				<?php foreach( $categories_2 as $category_2 ) { ?>
					<option value="<?php echo esc_attr( $category_2->term_id ); ?>" <?php selected( $instance['cat_2'], $category_2->term_id ); ?>><?php echo esc_html( $category_2->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat_3' ); ?>"><?php _e( 'Choose category for column #3', 'hemerken-gt' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat_3' ); ?>" name="<?php echo $this->get_field_name( 'cat_3' ); ?>" style="width:100%;">
				<?php $categories_3 = get_terms( 'category' ); ?>
				<option value="0"><?php _e( 'All categories &hellip;', 'hemerken-gt' ); ?></option>
				<?php foreach( $categories_3 as $category_3 ) { ?>
					<option value="<?php echo esc_attr( $category_3->term_id ); ?>" <?php selected( $instance['cat_3'], $category_3->term_id ); ?>><?php echo esc_html( $category_3->name ); ?></option>
				<?php } ?>
			</select>
		</p>	

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php _e( 'Number of posts to show', 'hemerken-gt' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['limit'] ); ?>" />
		</p>


	<?php

	}

}

/**
 * Column left posts
 */
function hemerken_gt_home_posts_left_col( $args, $instance ) {

	// Theme prefix
	$prefix = 'hemerken_gt-';

	// Pull the selected category.
	$cat_id = isset( $instance['cat'] ) ? absint( $instance['cat'] ) : 0;

	// Get the category.
	$category = get_category( $cat_id );

	// Get the category archive link.
	$cat_link = get_category_link( $cat_id );

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 4
	);

	// Limit to category based on user selected tag.
	if ( ! $cat_id == 0 ) {
		$args['cat'] = $cat_id;
	}

	// Allow dev to filter the post arguments.
	$query = apply_filters( 'hemerken_gt_home_three_columns_1_args', $args );

	// The post query.
	$posts = new WP_Query( $query );

	$i = 1;

	if ( $posts->have_posts() ) : ?>

		<div class="block-left">
		
			<?php require trailingslashit( get_template_directory() ) . 'template-parts/block-three-content.php';?>

		</div><!-- .block-left -->		

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();
}

/**
 * Column middle posts
 */
function hemerken_gt_home_posts_middle_col( $args, $instance ) {

	// Theme prefix
	$prefix = 'hemerken_gt-';

	// Pull the selected category.
	$cat_id = isset( $instance['cat_2'] ) ? absint( $instance['cat_2'] ) : 0;

	// Get the category.
	$category = get_category( $cat_id );

	// Get the category archive link.
	$cat_link = get_category_link( $cat_id );

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 4
	);

	// Limit to category based on user selected tag.
	if ( ! $cat_id == 0 ) {
		$args['cat'] = $cat_id;
	}

	// Allow dev to filter the post arguments.
	$query = apply_filters( 'hemerken_gt_home_three_columns_2_args', $args );

	// The post query.
	$posts = new WP_Query( $query );

	$i = 1;

	if ( $posts->have_posts() ) : ?>

		<div class="block-middle">

			<?php require trailingslashit( get_template_directory() ) . 'template-parts/block-three-content.php';?>

		</div><!-- .block-middle -->	

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();
}

/**
 * Column right posts
 */
function hemerken_gt_home_posts_right_col( $args, $instance ) {

	// Theme prefix
	$prefix = 'hemerken_gt-';

	// Pull the selected category.
	$cat_id = isset( $instance['cat_3'] ) ? absint( $instance['cat_3'] ) : 0;

	// Get the category.
	$category = get_category( $cat_id );

	// Get the category archive link.
	$cat_link = get_category_link( $cat_id );

	// Posts query arguments.
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 4
	);

	// Limit to category based on user selected tag.
	if ( ! $cat_id == 0 ) {
		$args['cat'] = $cat_id;
	}

	// Allow dev to filter the post arguments.
	$query = apply_filters( 'hemerken_gt_home_three_columns_3_args', $args );

	// The post query.
	$posts = new WP_Query( $query );

	$i = 1;

	if ( $posts->have_posts() ) : ?>

		<div class="block-right">

			<?php require trailingslashit( get_template_directory() ) . 'template-parts/block-three-content.php';?>

		</div><!-- .block-right -->	

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();	

}
