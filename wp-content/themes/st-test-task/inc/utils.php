<?php

function synapse_bootstrap_pagination( $wp_query = false, $echo = true, $args = array() ): false|string {
	// Fallback to $wp_query global variable if no query passed
	if ( false === $wp_query ) {
		global $wp_query;
	}

	// Set Defaults
	$defaults = array(
		'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		'format'       => '?paged=%#%',
		'current'      => max( 1, get_query_var( 'paged' ) ),
		'total'        => $wp_query->max_num_pages,
		'type'         => 'array',
		'show_all'     => false,
		'end_size'     => 2,
		'mid_size'     => 1,
		'prev_text'    => __( 'Newer' ),
		'next_text'    => __( 'Older' ),
		'add_fragment' => '',
	);

	// Merge the defaults with passed arguments
	$merged = wp_parse_args( $args, $defaults );

	// Get the paginated links
	$lists = paginate_links( $merged );

	if ( is_array( $lists ) ) {

		$html = '<nav><ul class="pagination my-4 justify-content-center">';

		foreach ( $lists as $list ) {
			$html .= '<li class="page-item' . ( str_contains( $list, 'current' ) ? ' active' : '' ) . '"> ' . str_replace( 'page-numbers', 'page-link', $list ) . '</li>';
		}

		$html .= '</ul></nav>';

		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
	}

	return false;
}