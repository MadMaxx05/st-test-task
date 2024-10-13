<?php

$footer_text = get_theme_mod( 'footer_text_setting', 'Default footer text' );

?>

<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">
			<?php echo do_shortcode( esc_html( get_theme_mod( 'footer_text_setting', 'Default footer text' ) ) ); ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>