<?php

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'rate-book', TEMPLATE_DIR_URI . '/source/js/rate-book.js', '', '', true );

	// Localize script to pass the AJAX URL
	wp_localize_script( 'rate-book', 'rate_book', [ 'ajax_url' => admin_url( 'admin-ajax.php' ) ] );
} );

function synapse_handle_rating(): void {

	if ( ! is_user_logged_in() ) {
		wp_send_json_error( 'You must be logged in to rate a book.' );

		return;
	}

	$book_id = intval( $_POST['book_id'] );
	$action  = sanitize_text_field( $_POST['action_type'] );

	$current_rating = get_post_meta( $book_id, 'rating', true );
	if ( ! $current_rating ) {
		$current_rating = 0;
	}

	if ( $action === 'plus' ) {
		$new_rating = $current_rating + 1;
	} elseif ( $action === 'minus' ) {
		$new_rating = $current_rating - 1;
	} else {
		wp_send_json_error( 'Invalid action type.' );

		return;
	}

	update_post_meta( $book_id, 'rating', $new_rating );

	wp_send_json_success( $new_rating );
}

// Register AJAX action for logged-in users
add_action( 'wp_ajax_rate_book', 'synapse_handle_rating' );

// Register AJAX action for logged-out users (optional)
add_action( 'wp_ajax_nopriv_rate_book', 'synapse_handle_rating' );