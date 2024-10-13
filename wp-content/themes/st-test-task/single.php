<?php get_header(); ?>

<div style="min-height: 75vh;" class="container mt-4">
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ): the_post(); ?>
            <div class="row">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title"><?php the_title(); ?></h2>
                        <p class="mb-0 text-muted">
                            Posted by: <?php the_author(); ?>
                        </p>
                        <p class="m-0 text-muted">Date: <?php echo get_the_date( 'M d, Y' ) ?></p>

						<?php if ( ! empty( get_the_content() ) ): ?>
                            <div class="mt-4"><?php the_content(); ?></div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
