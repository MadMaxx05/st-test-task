<?php get_header(); ?>

    <div style="min-height: 75vh;" class="container mt-4">
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php the_title(); ?></h5>
					<?php if ( ! empty( get_the_terms( get_the_ID(), 'author' )[0]->name ) ): ?>
                        <p class="mb-0 text-muted">
                            Author: <?php echo get_the_terms( get_the_ID(), 'author' )[0]->name; ?>
                        </p>
					<?php endif; ?>

					<?php if ( ! empty( get_the_terms( get_the_ID(), 'genre' )[0]->name ) ): ?>
                        <p class="mb-0 text-muted">
                            Genre: <?php echo get_the_terms( get_the_ID(), 'genre' )[0]->name; ?>
                        </p>
					<?php endif; ?>

                    <p class="m-0 text-muted">Release Date: <?php echo get_the_date( 'M d, Y' ) ?></p>

					<?php if ( ! empty( get_the_content() ) ): ?>
                        <div class="mt-4"><?php the_content(); ?></div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php get_footer(); ?>