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

	$term = get_term_by( 'slug', $attrs['genre'], 'genre' );

	if ( ! $term ) {
		return '<p>Genre not found.</p>';
	}

	$genre_name = $term->name;

	$args = [
		'post_type'      => 'book',
		'tax_query'      => [
			[
				'taxonomy' => 'genre',
				'field'    => 'slug',
				'terms'    => $attrs['genre'],
			],
		],
		'posts_per_page' => 10,
	];

	$query = new WP_Query( $args );

	if ( ! $query->have_posts() ) {
		return '<p>No books found for this genre.</p>';
	}

	$output = '<div class="card mb-4">
                    <div class="card-header">Best Picks from the ' . $genre_name . ' Genre' . '</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">';

	while ( $query->have_posts() ) {
		$query->the_post();

		$authors      = get_the_terms( get_the_ID(), 'author' );
		$author_names = [];

		if ( ! empty( $authors ) ) {
			foreach ( $authors as $author ) {
				$author_names[] = $author->name;
			}

			$author_list = implode( ', ', $author_names );
			$output      .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a> by ' . $author_list . '</li>';
		} else {
			$output .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
		}
	}

	$output .= '</ul></div></div>';

	wp_reset_postdata();

	return $output;
}

add_shortcode( 'books', 'display_books_by_genre_shortcode' );
