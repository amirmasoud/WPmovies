<?php
/* 
Plugin Name: Movies
Plugin URI: http://github.com/amirmasoud/WPmovies/
Description: Movies
Version: 1.0
Author: AmirMasoud Sheidayi
Author URI: http://chakosh.ir/
License: GPLv2 or later
*/

add_action( 'admin_menu', 'movie_menu' );
function movie_menu()
{
	add_menu_page( __('Movies', 'movie'), __('Movies', 'movie'), 'manage_options', 'movie', 'movie_admin', 'dashicons-format-video', 81 );
}

function movie_admin()
{

}

register_activation_hook( __FILE__, 'movie_install' );
function movie_install() {

}

register_deactivation_hook( __FILE__, 'movie_deactivation' );
function movie_deactivation() {

}