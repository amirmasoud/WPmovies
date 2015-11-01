<?php
/**
 * on plugin activation
 * @return void
 */
function movie_install() { 
    // Trigger movie_CPT_init
    movie_cpt_init();
 
    // Clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'movie_install' );