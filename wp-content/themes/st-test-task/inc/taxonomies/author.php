<?php

/**
 * Registers the `author` taxonomy,
 * for use with 'book'.
 */
function synapse_author_init() {
	register_taxonomy( 'author', [ 'book' ], [
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
			'name'                       => __( 'Authors', 'synapse' ),
			'singular_name'              => _x( 'Author', 'taxonomy general name', 'synapse' ),
			'search_items'               => __( 'Search Authors', 'synapse' ),
			'popular_items'              => __( 'Popular Authors', 'synapse' ),
			'all_items'                  => __( 'All Authors', 'synapse' ),
			'parent_item'                => __( 'Parent Author', 'synapse' ),
			'parent_item_colon'          => __( 'Parent Author:', 'synapse' ),
			'edit_item'                  => __( 'Edit Author', 'synapse' ),
			'update_item'                => __( 'Update Author', 'synapse' ),
			'view_item'                  => __( 'View Author', 'synapse' ),
			'add_new_item'               => __( 'Add New Author', 'synapse' ),
			'new_item_name'              => __( 'New Author', 'synapse' ),
			'separate_items_with_commas' => __( 'Separate Authors with commas', 'synapse' ),
			'add_or_remove_items'        => __( 'Add or remove Authors', 'synapse' ),
			'choose_from_most_used'      => __( 'Choose from the most used Authors', 'synapse' ),
			'not_found'                  => __( 'No Authors found.', 'synapse' ),
			'no_terms'                   => __( 'No Authors', 'synapse' ),
			'menu_name'                  => __( 'Authors', 'synapse' ),
			'items_list_navigation'      => __( 'Authors list navigation', 'synapse' ),
			'items_list'                 => __( 'Authors list', 'synapse' ),
			'most_used'                  => _x( 'Most Used', 'author', 'synapse' ),
			'back_to_items'              => __( '&larr; Back to Authors', 'synapse' ),
		],
		'show_in_rest'          => true,
		'rest_base'             => 'author',
		'rest_controller_class' => 'WP_REST_Terms_Controller',
	] );

}

add_action( 'init', 'synapse_author_init' );

/**
 * Sets the post updated messages for the `author` taxonomy.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `author` taxonomy.
 */
function synapse_author_updated_messages( $messages ) {

	$messages['author'] = [
		0 => '', // Unused. Messages start at index 1.
		1 => __( 'Author added.', 'synapse' ),
		2 => __( 'Author deleted.', 'synapse' ),
		3 => __( 'Author updated.', 'synapse' ),
		4 => __( 'Author not added.', 'synapse' ),
		5 => __( 'Author not updated.', 'synapse' ),
		6 => __( 'Authors deleted.', 'synapse' ),
	];

	return $messages;
}

add_filter( 'term_updated_messages', 'synapse_author_updated_messages' );
