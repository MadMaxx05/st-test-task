<?php

/**
 * Registers the `genre` taxonomy,
 * for use with 'book'.
 */
function synapse_genre_init() {
	register_taxonomy( 'genre', [ 'book' ], [
		'hierarchical'          => false,
		'public'                => true,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_admin_column'     => false,
		'query_var'             => true,
		'rewrite'               => true,
		'capabilities'          => [
			'manage_terms' => 'edit_posts',
			'edit_terms'   => 'edit_posts',
			'delete_terms' => 'edit_posts',
			'assign_terms' => 'edit_posts',
		],
		'labels'                => [
			'name'                       => __( 'Genres', 'synapse' ),
			'singular_name'              => _x( 'Genre', 'taxonomy general name', 'synapse' ),
			'search_items'               => __( 'Search Genres', 'synapse' ),
			'popular_items'              => __( 'Popular Genres', 'synapse' ),
			'all_items'                  => __( 'All Genres', 'synapse' ),
			'parent_item'                => __( 'Parent Genre', 'synapse' ),
			'parent_item_colon'          => __( 'Parent Genre:', 'synapse' ),
			'edit_item'                  => __( 'Edit Genre', 'synapse' ),
			'update_item'                => __( 'Update Genre', 'synapse' ),
			'view_item'                  => __( 'View Genre', 'synapse' ),
			'add_new_item'               => __( 'Add New Genre', 'synapse' ),
			'new_item_name'              => __( 'New Genre', 'synapse' ),
			'separate_items_with_commas' => __( 'Separate Genres with commas', 'synapse' ),
			'add_or_remove_items'        => __( 'Add or remove Genres', 'synapse' ),
			'choose_from_most_used'      => __( 'Choose from the most used Genres', 'synapse' ),
			'not_found'                  => __( 'No Genres found.', 'synapse' ),
			'no_terms'                   => __( 'No Genres', 'synapse' ),
			'menu_name'                  => __( 'Genres', 'synapse' ),
			'items_list_navigation'      => __( 'Genres list navigation', 'synapse' ),
			'items_list'                 => __( 'Genres list', 'synapse' ),
			'most_used'                  => _x( 'Most Used', 'genre', 'synapse' ),
			'back_to_items'              => __( '&larr; Back to Genres', 'synapse' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'genre',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'synapse_genre_init' );

/**
 * Sets the post updated messages for the `genre` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `genre` taxonomy.
 */
function synapse_genre_updated_messages( $messages ) {

	$messages['genre'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Genre added.', 'synapse' ),
		2 => __( 'Genre deleted.', 'synapse' ),
		3 => __( 'Genre updated.', 'synapse' ),
		4 => __( 'Genre not added.', 'synapse' ),
		5 => __( 'Genre not updated.', 'synapse' ),
		6 => __( 'Genres deleted.', 'synapse' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'synapse_genre_updated_messages' );
