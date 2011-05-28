<?php

// Inicio Benchmark



//$app->add_event('on_init','on_init');
$app->add_event('before_show','before_show');
$app->add_event('on_complete','on_complete');

function on_init() {
	//echo 'on_init';
}

function before_show() {
	//echo 'before_show';
}

function on_complete() {
	echo 'on_complete';
}

?>