<?php get_header(); ?>

    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-lg-6">
                                <div class="card mb-4">
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="card-img-top"
                                             src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                             alt="..."/>
                                    </a>
                                    <div class="card-body">
                                        <div class="small text-muted"><?php the_date( 'M d, Y' ); ?></div>
                                        <h2 class="card-title h4"><?php the_title(); ?></h2>
                                        <div class="card-text"><?php the_excerpt(); ?></div>
                                        <a class="btn btn-primary" href="<?php the_permalink(); ?>">Read more →</a>
                                    </div>
                                </div>
                            </div>
						<?php endwhile; ?>

						<?php if ( synapse_bootstrap_pagination() ): ?>
                            <hr class="my-0"/>
						<?php endif; ?>

						<?php synapse_bootstrap_pagination(); ?>

					<?php endif; ?>
                </div>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-4">
				<?php get_sidebar( 'sidebar' ); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>