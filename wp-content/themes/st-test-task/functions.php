<?php

define( 'TEMPLATE_DIR', get_template_directory() );
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );

require_once TEMPLATE_DIR . '/inc/post-types/book.php';
require_once TEMPLATE_DIR . '/inc/taxonomies/genre.php';
require_once TEMPLATE_DIR . '/inc/taxonomies/author.php';
require_once TEMPLATE_DIR . '/inc/shortcodes.php';
require_once TEMPLATE_DIR . '/inc/widgets/latest_books_by_author.php';
require_once TEMPLATE_DIR . '/inc/utils.php';
require_once TEMPLATE_DIR . '/inc/customizer.php';
require_once TEMPLATE_DIR . '/inc/admin-ajax.php';

if ( ! function_exists( 'synapse_setup' ) ) {
	function synapse_setup(): void {
		/**
		 * Register custom nav menus
		 */
		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary menu', 'synapse' ),
			]
		);
	}
}

add_action( 'after_setup_theme', 'synapse_setup' );

function synapse_scripts(): void {
	// Enqueue theme stylesheet
	wp_enqueue_style( 'synapse-styles', TEMPLATE_DIR_URI . '/source/css/styles.css' );

	// Enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', [], null );
}

add_action( 'wp_enqueue_scripts', 'synapse_scripts' );

add_filter( 'widget_text', 'do_shortcode' );

function widgets_init(): void {
	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'synapse' ),
		'id'            => 'primary-sidebar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'synapse' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'widgets_init' );