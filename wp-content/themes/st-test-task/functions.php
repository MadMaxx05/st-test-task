<?php

define( 'TEMPLATE_DIR', get_template_directory() );
define( 'TEMPLATE_DIR_URI', get_template_directory_uri() );

function synapse_scripts() {
	// Enqueue theme stylesheet
	wp_enqueue_style( 'synapse-styles', TEMPLATE_DIR_URI . '/source/css/styles.css' );

	// Enqueue Bootstrap JS
	wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', [], null );
}

add_action( 'wp_enqueue_scripts', 'synapse_scripts' );