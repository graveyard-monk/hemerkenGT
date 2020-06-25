<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hemerken_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'hemerken' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'hemerken' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage Content', 'newsnow-pro' ),
		'id'            => 'homepage',
		'description'   => esc_html__( 'Only put "Home One/Two/Three Columns" and "Advertisement" widgets here.', 'newsnow-pro' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

}
add_action( 'widgets_init', 'hemerken_widgets_init' );