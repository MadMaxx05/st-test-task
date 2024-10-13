<?php get_header(); ?>

    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder"><?php the_title(); ?></h1>
                <div class="lead mb-0"><?php the_content(); ?></div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
			<?php

			$currentYear  = date( 'Y' );
			$currentMonth = date( 'n' );
			$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // Get the current page number

			$args = [
				'post_type'      => 'book',
				'paged'          => $paged,
				'date_query'     => [
					[
						'year'  => $currentYear,
						'month' => $currentMonth
					],
				],
				'posts_per_page' => 6,
			];

			$books_query = new WP_Query( $args );
			if ( $books_query->have_posts() ):
				while ( $books_query->have_posts() ) : $books_query->the_post(); ?>
                    <div class="col-lg-4">
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

                                <a class="mt-2 btn btn-outline-primary" href="<?php the_permalink(); ?>">Learn more
                                    →</a>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>

                <hr class="my-0"/>

				<?php synapse_bootstrap_pagination( $books_query );
			else:
				echo 'There is no books';
			endif;

			wp_reset_postdata();

			?>
        </div>
    </div>

<?php get_footer(); ?>