<?php

class MoviesCacheFlushTest extends WP_UnitTestCase {

	function test_movie_cache_flush() { 
		$this->assertNull( movie_cache_flush() );
	}
}

