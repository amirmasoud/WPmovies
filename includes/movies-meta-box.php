<?php
/**
 * Add custom meta box for rate and publish year
 * @return void
 */
function movie_add_meta_box() {
	add_meta_box('movie_rating', __('Rating', 'movie'), 'movie_rating_meta_box_callback', 'movies');
	add_meta_box('movie_year', __('Publish year', 'movie'), 'movie_year_meta_box_callback', 'movies');
}

/**
 * Callback function of rating movie, to generate inputs on movies post type
 * @param  stdObj $post
 * @return HTML
 */
function movie_rating_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field('movie_save_meta_box_data', 'movie_meta_box_nonce');

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$movie_rating_value = get_post_meta($post->ID, 'movie_rating', true);

	// generate input of type number for rating movies
	// with range of 0-10 and step 0.1
	echo '<label for="movie_rating">';
	_e( 'Rate of the movie from 0 to 10', 'movie' );
	echo '</label> ';
	echo '<input type="number" id="movie_rating" name="movie_rating" value="' . esc_attr($movie_rating_value) . '" min="0" max="10" step="0.1" />';
}
add_action('add_meta_boxes', 'movie_add_meta_box');

/**
 * Callback fucntion of publishing movie year, to generate inputs on movies post type
 * @param  stdObj $post
 * @return HTML
 */
function movie_year_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
	wp_nonce_field('movie_save_meta_box_data', 'movie_meta_box_nonce');

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$movie_year_value = get_post_meta($post->ID, 'movie_year', true);

	// generate input of type number for rating movies
	// with range 1950-2050 and step 1
	echo '<label for="movie_year">';
	_e( 'Published year', 'movie' );
	echo '</label> ';
	echo '<input type="number" id="movie_year" name="movie_year" value="' . esc_attr($movie_year_value) . '" min="1950" max="2050" step="1" />';
}
add_action('add_meta_boxes', 'movie_add_meta_box');

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function movie_save_meta_box_data($post_id) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['movie_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['movie_meta_box_nonce'], 'movie_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['movie_rating'] ) || 
		 ! isset( $_POST['movie_year'] ) ) {
		return;
	}

	// now that we now movie_rating is set let validate it to our custom values
	if ( $_POST['movie_rating'] > 10 || $_POST['movie_rating'] < 0 ) {
		return;
	}

	if ( $_POST['movie_year'] > 2050 || $_POST['movie_year'] < 1950 ) {
		return;
	}

	// Sanitize user input.
	$movie_rating_data = sanitize_text_field( $_POST['movie_rating'] );
	$movie_year_data = sanitize_text_field( $_POST['movie_year'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, 'movie_rating', $movie_rating_data );
	update_post_meta( $post_id, 'movie_year', $movie_year_data );
}
add_action( 'save_post', 'movie_save_meta_box_data' );