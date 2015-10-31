<?php
/**
 * Flush movies cache
 * @return void
 */
function movie_cache_flush() {
	// get movies
	$loop = new WP_Query( array('post_type' => 'movies' ) );

	// grep number of pages as loop through it
	for ($cache_number = 1; $cache_number <= $loop->max_num_pages; $cache_number++) :
		// generate cache name
		$cache_name = MOVIE_CAHCE_PREFIX . $cache_number;

		// delete cache
		delete_transient($cache_name);
	endfor;
	
	wp_reset_postdata();
}
add_action('trash_movies', 'movie_cache_flush', 10);
add_action('delete_movies', 'movie_cache_flush', 10);
add_action('new_movies', 'movie_cache_flush', 10);
add_action('publish_movies', 'movie_cache_flush', 10);
add_action('pending_movies', 'movie_cache_flush', 10);
add_action('draft_movies', 'movie_cache_flush', 10);
add_action('private_movies', 'movie_cache_flush', 10);
