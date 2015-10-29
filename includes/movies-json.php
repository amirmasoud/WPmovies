<?php
function movie_json() {
	if ( ! isset($_GET['api']) )
    	return;

	// initialize return array
	$json_return = array('data' => array());

	// new loop through movie CPT
	$loop = new WP_Query( array('post_type' =>  'movies') );
	if ( $loop->have_posts() ) :
		while ( $loop->have_posts() ) : $loop->the_post();
			// get thumbnail
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'thumbnail' );

			// push to return array
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