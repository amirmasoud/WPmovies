<?php
/**
 * Add movies shortcode
 * @return HTML
 */
function movies_shortcode(){
	wp_enqueue_script('movies-angularjs', 'http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js');
	wp_enqueue_script('movies-angularjs-animate', 'http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-animate.min.js');
	wp_enqueue_script('movies-app', MOVIE_PLUGIN_URL . 'js/moviesApp.js', array('movies-angularjs', 'movies-angularjs-animate'));
	wp_enqueue_style('movies-angular-animate', MOVIE_PLUGIN_URL . 'css/ng-animate.css');

	echo '<div id="movies" class="movies" ng-app="moviesApp" ng-controller="moviesController" data-ajax="' . get_site_url() . '/?api=1&paged=1' . '"  ng-animate="\'animate\'"> 
			<div class="movie" ng-repeat="movie in data">
				<div class="movie-poster">
					<img ng-src="{{ movie.poster_url }}" />
				</div><!-- .movie-poster -->
				<h1><span ng-bind="movie.title" /></h1>
				<div class="movie-meta">
					<span class="movie-year">' . __('Published in', 'movie') . ' <span ng-bind="movie.year" /></span><!-- .movie-year -->
					<span class="movie-meta-seprator">' . __(' | ', 'movie') . '</span><!-- .movie-meta-seprator -->
					<span class="movie-rating">' . __('Rating', 'movie') . ' <span ng-bind="movie.rating" />' . __('of 10', 'movie') . '</span><!-- .movie-rating -->
				</div><!-- .movie-meta -->
				<div class="movie-description" ng-bind-html="movie.short_description"></div><!-- .movie-description -->
			</div><!-- .movie -->
			<button ng-show="loadMoreVisi" ng-click="loadMore()" id="load-more" data-next="{{ links.next.href }}">' . __('Load More...', 'movie') . '</button>
		</div><!-- .movies -->';
}


/**
 * add shortcode
 * @return void
 */
function movies_register_shortcode() {
    add_shortcode( 'movies', 'movies_shortcode' );
}
add_action( 'init', 'movies_register_shortcode' );
