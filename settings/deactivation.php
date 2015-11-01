<?php
/**
 * on plugin deactivation
 * Our movie post type will be automatically removed, so no need to unregister it
 * @return void
 */
function movie_deactivation() {
	// Clear the permalinks to remove our post type's rules
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'movie_deactivation' );