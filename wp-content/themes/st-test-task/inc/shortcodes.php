<?php

/**
 * Register the shortcode `[books genre="name"]`
 */
function display_books_by_genre_shortcode( $attrs ) {
	$attrs = shortcode_atts(
		[
			'genre' => '',
		],
		$attrs,
		'books'
	);

	if ( empty( $attrs['genre'] ) ) {
		return '<p>Please specify a genre.</p>';
	}

	$args = [
		'post_type'      => 'book',
		'tax_query'      => [
			[
				'taxonomy' => 'genre',
				'field'    => 'slug',
				'terms'    => $attrs['genre'],
			],
		],
		'posts_per_page' => - 1,
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return '<p>No books found for this genre.</p>';
	}

	$output = '<ul class="books-list">';

	while ( $query->have_posts() ) {
		$query->the_post();
		$output .= '<li>' . get_the_title() . ' by ' . get_the_author() . '</li>';
	}

	$output .= '</ul>';

	wp_reset_postdata();

	return $output;
}

add_shortcode( 'books', 'display_books_by_genre_shortcode' );
