<?php
/**
 * Register movie post type
 * @return void
 */
function movie_cpt_init() {
	// custom lables for movie post type
	$labels = array(
		'name'               => _x( 'Movies', 'post type general name', 'movie' ),
		'singular_name'      => _x( 'Movie', 'post type singular name', 'movie' ),
		'menu_name'          => _x( 'Movies', 'admin menu', 'movie' ),
		'name_admin_bar'     => _x( 'Movie', 'add new on admin bar', 'movie' ),
		'add_new'            => _x( 'Add New', 'movie', 'movie' ),
		'add_new_item'       => __( 'Add New Movie', 'movie' ),
		'new_item'           => __( 'New Movie', 'movie' ),
		'edit_item'          => __( 'Edit Movie', 'movie' ),
		'view_item'          => __( 'View Movie', 'movie' ),
		'all_items'          => __( 'All Movies', 'movie' ),
		'search_items'       => __( 'Search Movies', 'movie' ),
		'parent_item_colon'  => __( 'Parent Movies:', 'movie' ),
		'not_found'          => __( 'No movies found.', 'movie' ),
		'not_found_in_trash' => __( 'No movies found in Trash.', 'movie' )
	);

	// custom arguments for movie post type
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'movie' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'	         => 'dashicons-format-video',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'movies' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 81,
		'supports'           => array( 'title', 'thumbnail', 'editor', 'revisions' )
	);
	register_post_type( 'movies', $args );

}
add_action( 'init', 'movie_cpt_init' );