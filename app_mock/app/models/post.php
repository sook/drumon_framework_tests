<?php

	/**
	* 
	*/
	class Post extends DrumonModel {
		
		public $table_name = 'blog_posts';
		
		public $behaviors = array('Paginate');
		
		public $per_page = 2;
		
		//protected $attr_protected = array('title');
		
		
		public $before_create = array();
		public $before_save = array('auto_dates');
		public $before_update = array();
		public $before_delete = array('print_id');

		public $after_create = array();
		public $after_save = array();
		public $after_update = array('print_title');
		public $after_delete = array('remove_image');

		public function after_initialize() {
			
		}
		
		protected function auto_dates() {
			if ($this->is_new()) {
				$this->created_at = Date('Y-m-d h:m');
			} else {
				$this->updated_at = Date('Y-m-d h:m');
			}
		}
		
		public function default_scope() {
			return $this->order('blog_posts.id DESC');
		}
		
		public function print_title() {
		//	echo $this->title;
		}
		
		public function remove_image() {
			echo '<br>remove imagem '.$this->id.'.jpg<br>';
		}
		
		public function print_id() {
			echo $this->id;
		}
		
		public function deleted() {
			return $this->where('deleted = 1');
		}

		public function get_title() {
			return ucfirst($this->read_attribute('title'));
		}
		
		public function set_title($value) {
			$this->write_attribute('title', $value.'[alterado]');
		}
		
		public function get_comments() {
			return 'a';
		}
		
	}
?>