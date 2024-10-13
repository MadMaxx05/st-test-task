<?php

class Latest_Books_By_Author_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'latest_books_by_author',
			'Latest Books by Author',
			[ 'description' => __( 'Displays the latest 5 books from a specific author' ) ]
		);
	}

	public function form( $instance ) {
		$author = ! empty( $instance['author'] ) ? $instance['author'] : '';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php _e( 'Author Name:' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'author' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $author ); ?>">
        </p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance           = [];
		$instance['author'] = ( ! empty( $new_instance['author'] ) ) ? sanitize_text_field( $new_instance['author'] ) : '';

		return $instance;
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['author'] ) ) {
			$this->display_books( $instance['author'] );
		}
		echo $args['after_widget'];
	}

	private function display_books( $author_name ) {
		$query_args = [
			'post_type'      => 'book',
			'tax_query'      => [
				[
					'taxonomy' => 'author',
					'field'    => 'name',
					'terms'    => $author_name
				]
			],
			'posts_per_page' => 5,
		];

		$books_query = new WP_Query( $query_args );

		echo '<div class="card mb-4">
                    <div class="card-header">Latest Books by ' . $author_name . '</div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">';

		if ( $books_query->have_posts() ) {
			while ( $books_query->have_posts() ) {
				$books_query->the_post();
				echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
			}
		} else {
			echo 'No books found for this author.';
		}

		echo '</ul></div></div>';

		wp_reset_postdata();
	}
}

function register_latest_books_by_author_widget() {
	register_widget( 'Latest_Books_By_Author_Widget' );
}

add_action( 'widgets_init', 'register_latest_books_by_author_widget' );

$latest_books_by_author_widget = new Latest_Books_By_Author_Widget();