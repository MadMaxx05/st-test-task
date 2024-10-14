<?php get_header(); ?>

<?php

$rating = get_post_meta( get_the_ID(), 'rating', true ) ?: 0;

?>

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

                    <div class="mt-4">
                        <p data-rating-<?php echo get_the_ID(); ?>>Rating: <?php echo esc_html( $rating ); ?></p>
                        <button data-rate-button data-book-id="<?php echo get_the_ID(); ?>" data-action="minus">-1
                        </button>
                        <button data-rate-button data-book-id="<?php echo get_the_ID(); ?>" data-action="plus">+1
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>