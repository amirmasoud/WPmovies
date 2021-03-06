<?php
/**
 * Create JSON API for movie CPT and its pages with cache
 * @return JSON
 */
function movie_json() {
	// are we one the api page?
	// or is php unit runnig
	if ( ! isset($_GET['api']) &&
		 ! defined('MOVIE_PHPUNIT_RUNNING') )
    	return;

    // get current page
    $current_page = get_query_var( 'paged', 1 );

	// current page on first page return 0 but we need 1
	$current_page = ($current_page == 0) ? 1 : $current_page;

	// name of the cache of this page
    $movie_cache = MOVIE_CAHCE_PREFIX . $current_page;

    // check if we have the cache for this page
	if ( false === ( $value = get_transient( $movie_cache ) ) ) :

		// new loop through movie CPT
		$loop = new WP_Query( array('post_type' =>  'movies', 'paged' =>  $current_page) );

		// generate next & prev page number
	    $prev_page = ( $current_page - 1 > 0 ) ? $current_page - 1 : null;
	    $next_page = ( $current_page + 1 <= $loop->max_num_pages ) ? $current_page + 1 : null;

		// initialize return array
		$json_return = array('data' => array());

		// set pagination format based on JSON API
		$json_return = array('links' => array(
				'first' => array('href' => get_site_url() . '?api=1&paged=1'),
				'last'  => array('href' => get_site_url() . '?api=1&paged=' . $loop->max_num_pages),
				'prev'  => array('href' => get_site_url() . '?api=1&paged=' . $prev_page),
				'next'  => array('href' => get_site_url() . '?api=1&paged=' . $next_page)
			));

		if ( $loop->have_posts() ) :
			while ( $loop->have_posts() ) : $loop->the_post();
				// get thumbnail
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail_src = wp_get_attachment_image_src( $thumbnail_id );

				// push to return array based on JSON API
				$json_return['data'][] = array(
					'id' 				=> get_the_ID(),
					'title' 			=> get_the_title(),
					'poster_url' 		=> $thumbnail_src[0], // grep just src part
					'year' 				=> get_post_meta(get_the_ID(), 'movie_year', true),
					'rating'			=> get_post_meta(get_the_ID(), 'movie_rating', true),
					'short_description' => get_the_content()
					);
			endwhile;
		endif;

		// if no movie added yet, handling empty result
		if ( ! array_key_exists('data', $json_return) ) :
			// push to return array based on JSON API
			$json_return['data'][] = array(
				'id' 				=> '0',
				'title' 			=> __('No movie yet...', 'movies'),
				'poster_url' 		=> '',
				'year' 				=> '',
				'rating'			=> '',
				'short_description' => "<h3>" . __('Create your first movie', 'movies') . ", <a href=" . admin_url() .  "'/post-new.php?post_type=movies'>" . __('Create new movie', 'movies') . "</a></h3>"
				);
		endif;
		wp_reset_postdata();

		// set persistance cache for one day
		// we will also flush the cache on new post
		set_transient( $movie_cache, $json_return, DAY_IN_SECONDS);

		// wp_send_json return json and execte die()
		// not good for php unit, so we check if
		// it's phpunit we encode and return
		// it's inside of 'if' so it's check it when generating
		// cache not every time it wants to return actual data
		if (defined('MOVIE_PHPUNIT_RUNNING'))
			return json_encode(get_transient( $movie_cache ));
	endif;

	// create json and die for cache that we created or had before
	wp_send_json( get_transient( $movie_cache ) );
}
add_action( 'template_redirect', 'movie_json' );