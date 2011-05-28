<?php

	class BeforeAfterController extends AppController {
		
		var $before_action = array(
			'authenticate', // executa antes de todas as actions
			'load_post_2' => array('only'=>'test_only'), //executa somente antes da test_only
			'load_post_1' => array('except'=>'test_only') //executa em todas menos na test_only
		);
		
		function simple() {
			$this->add('post', $this->post);
		}
		
		function test_only() {
			$this->add('post', $this->post);
		}
		
		
		protected function load_post_1() {
			$this->post = 'Post 1';
		}
		
		protected function load_post_2() {
			$this->post = 'Post 2';
		}
		
	}
?>