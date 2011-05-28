<?php

	$steps->Then('/^the url should be match "([^"]*)"$/', function($world, $pattern) use ($steps) {
		assertEquals($world->getSession()->getCurrentUrl(),$pattern);
	});

?>