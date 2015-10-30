<?php
/* 
Plugin Name: Movies
Plugin URI: http://github.com/amirmasoud/WPmovies/
Description: Movies
Version: 1.0
Author: AmirMasoud Sheidayi
Author URI: http://chakosh.ir/
Textdomain: movie
License: GPLv2 or later
*/
/**
 * NOTICE: in some case order matters
 */
// Constrants
define('MOVIE_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('MOVIE_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('MOVIE_CAHCE_PREFIX', 'movie_cache_');

// settings
require_once(MOVIE_PLUGIN_PATH . 'settings/install.php');
require_once(MOVIE_PLUGIN_PATH . 'settings/deactivation.php');

// includes
require_once(MOVIE_PLUGIN_PATH . 'includes/movies-post-type.php');
require_once(MOVIE_PLUGIN_PATH . 'includes/movies-meta-box.php');
require_once(MOVIE_PLUGIN_PATH . 'includes/movies-json.php');
require_once(MOVIE_PLUGIN_PATH . 'includes/movies-cache-flush.php');