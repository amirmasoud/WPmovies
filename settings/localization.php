<?php
/**
 * Load plugin textdomain.
 */
function movies_load_textdomain() {
	load_plugin_textdomain('movies', false, MOVIE_PLUGIN_PATH . '/languages' ); 
}
add_action('plugins_loaded', 'movies_load_textdomain');
