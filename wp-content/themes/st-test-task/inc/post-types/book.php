<?php

/**
 * Registers the `book` post type.
 */
function synapse_book_init() {
	register_post_type(
		'book',
		[
			'labels'                => [
				'name'                  => __( 'Books', 'synapse' ),
				'singular_name'         => __( 'Book', 'synapse' ),
				'all_items'             => __( 'All Books', 'synapse' ),
				'archives'              => __( 'Book Archives', 'synapse' ),
				'attributes'            => __( 'Book Attributes', 'synapse' ),
				'insert_into_item'      => __( 'Insert into Book', 'synapse' ),
				'uploaded_to_this_item' => __( 'Uploaded to this Book', 'synapse' ),
				'featured_image'        => _x( 'Featured Image', 'book', 'synapse' ),
				'set_featured_image'    => _x( 'Set featured image', 'book', 'synapse' ),
				'remove_featured_image' => _x( 'Remove featured image', 'book', 'synapse' ),
				'use_featured_image'    => _x( 'Use as featured image', 'book', 'synapse' ),
				'filter_items_list'     => __( 'Filter Books list', 'synapse' ),
				'items_list_navigation' => __( 'Books list navigation', 'synapse' ),
				'items_list'            => __( 'Books list', 'synapse' ),
				'new_item'              => __( 'New Book', 'synapse' ),
				'add_new'               => __( 'Add New', 'synapse' ),
				'add_new_item'          => __( 'Add New Book', 'synapse' ),
				'edit_item'             => __( 'Edit Book', 'synapse' ),
				'view_item'             => __( 'View Book', 'synapse' ),
				'view_items'            => __( 'View Books', 'synapse' ),
				'search_items'          => __( 'Search Books', 'synapse' ),
				'not_found'             => __( 'No Books found', 'synapse' ),
				'not_found_in_trash'    => __( 'No Books found in trash', 'synapse' ),
				'parent_item_colon'     => __( 'Parent Book:', 'synapse' ),
				'menu_name'             => __( 'Books', 'synapse' ),
			],
			'public'                => true,
			'hierarchical'          => false,
			'show_ui'               => true,
			'show_in_nav_menus'     => true,
			'supports'              => [ 'title', 'editor' ],
			'has_archive'           => true,
			'rewrite'               => true,
			'query_var'             => true,
			'menu_position'         => null,
			'menu_icon'             => 'dashicons-book',
			'show_in_rest'          => true,
			'rest_base'             => 'book',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
		]
	);

}

add_action( 'init', 'synapse_book_init' );

/**
 * Sets the post updated messages for the `book` post type.
 *
 * @param array $messages Post updated messages.
 *
 * @return array Messages for the `book` post type.
 */
function synapse_book_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['book'] = [
		0  => '',
		// Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Book updated. <a target="_blank" href="%s">View Book</a>', 'synapse' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'synapse' ),
		3  => __( 'Custom field deleted.', 'synapse' ),
		4  => __( 'Book updated.', 'synapse' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s', 'synapse' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Book published. <a href="%s">View Book</a>', 'synapse' ), esc_url( $permalink ) ),
		7  => __( 'Book saved.', 'synapse' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Book submitted. <a target="_blank" href="%s">Preview Book</a>', 'synapse' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Book scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Book</a>', 'synapse' ), date_i18n( __( 'M j, Y @ G:i', 'synapse' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Book draft updated. <a target="_blank" href="%s">Preview Book</a>', 'synapse' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	];

	return $messages;
}

add_filter( 'post_updated_messages', 'synapse_book_updated_messages' );

/**
 * Sets the bulk post updated messages for the `book` post type.
 *
 * @param array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param int[] $bulk_counts Array of item counts for each message, used to build internationalized strings.
 *
 * @return array Bulk messages for the `book` post type.
 */
function synapse_book_bulk_updated_messages( $bulk_messages, $bulk_counts ) {
	global $post;

	$bulk_messages['book'] = [
		/* translators: %s: Number of Books. */
		'updated'   => _n( '%s Book updated.', '%s Books updated.', $bulk_counts['updated'], 'synapse' ),
		'locked'    => ( 1 === $bulk_counts['locked'] ) ? __( '1 Book not updated, somebody is editing it.', 'synapse' ) :
			/* translators: %s: Number of Books. */
			_n( '%s Book not updated, somebody is editing it.', '%s Books not updated, somebody is editing them.', $bulk_counts['locked'], 'synapse' ),
		/* translators: %s: Number of Books. */
		'deleted'   => _n( '%s Book permanently deleted.', '%s Books permanently deleted.', $bulk_counts['deleted'], 'synapse' ),
		/* translators: %s: Number of Books. */
		'trashed'   => _n( '%s Book moved to the Trash.', '%s Books moved to the Trash.', $bulk_counts['trashed'], 'synapse' ),
		/* translators: %s: Number of Books. */
		'untrashed' => _n( '%s Book restored from the Trash.', '%s Books restored from the Trash.', $bulk_counts['untrashed'], 'synapse' ),
	];

	return $bulk_messages;
}

add_filter( 'bulk_post_updated_messages', 'synapse_book_bulk_updated_messages', 10, 2 );
