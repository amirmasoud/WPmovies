<?php
function movie_json() {
	if ( ! isset($_GET['api']) )
    	return;

    // get current page
    $current_page = get_query_var( 'paged', 1 );

    // current page on first page return 0 but we need 1
    $current_page = ($current_page == 0) ? 1 : $current_page;

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
			$thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

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
	wp_reset_postdata();

	// create json and die
	wp_send_json( $json_return );
}
add_action( 'template_redirect', 'movie_json' );