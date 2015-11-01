<?php
/**
 * Load plugin textdomain.
 */
function movies_load_textdomain() {
	load_plugin_textdomain('movies', false, basename( dirname( __FILE__ ) ) . '/languages/' . '/languages' ); 
}
add_action('plugins_loaded', 'movies_load_textdomain');
