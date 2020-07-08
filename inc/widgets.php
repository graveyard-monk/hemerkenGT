<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hemerken_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Sidebar', 'hemerken_gt' ),
		'id'            => 'homepage-sidebar',
		'description'   => esc_html__( 'If empty, homepage sidebar will display the "Sidebar" widgets above.', 'hemerken_gt' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Content', 'hemerken' ),
		'id'            => 'homepage',
		'description'   => esc_html__( 'Only put "Home One/Two/Three Columns" and "Advertisement" widgets here.', 'hemerken' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'hemerken-gt' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here. Display on every pages.', 'hemerken-gt' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
		) );

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'hemerken-gt' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hemerken-gt' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'hemerken_widgets_init' );

