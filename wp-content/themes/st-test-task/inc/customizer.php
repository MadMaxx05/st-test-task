<?php

function synapse_customize_register( $wp_customize ): void {
	$wp_customize->add_section( 'footer_section', [
		'title'    => __( 'Footer Settings', 'synapse' ),
		'priority' => 120,
	] );

	$wp_customize->add_setting( 'footer_text_setting', [
		'default'           => __( 'Copyright © Your Website [year]', 'synapse' ),
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	] );
	
	$wp_customize->add_control( 'footer_text_control', [
		'label'    => __( 'Footer Text', 'synapse' ),
		'section'  => 'footer_section',
		'settings' => 'footer_text_setting',
		'type'     => 'text',
	] );
}

add_action( 'customize_register', 'synapse_customize_register' );
