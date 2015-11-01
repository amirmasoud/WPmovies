<?php

class MoviesJsonTest extends WP_UnitTestCase {

	function test_movies_json() { 
		$this->assertJson( movie_json() );
	}
}

