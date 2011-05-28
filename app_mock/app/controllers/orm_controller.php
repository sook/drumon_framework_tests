<?php

	/**
	* 
	*/
	class OrmController extends AppController {
		
		function queries() {
			$post_model = new Post();
			
			$simple = $post_model->find(10);
			

			
			//$join_array = $post_model->join(array('user'))->to_sql();
			
			//$post_model = new Post();
			$page_number = isset($this->params['page']) ? $this->params['page'] : 1;
			
			$posts = $post_model->where('1 = 1')->page($page_number);
			print_r($posts->total_records);
			//$posts = $post_model->join('INNER JOIN core_users ON core_users.id = blog_posts.user_id')->page($page_number);
			//$posts = $post_model->select('blog_posts.id')->join('INNER JOIN core_users ON core_users.id = blog_posts.user_id')->page($page_number);
			
			$this->add('posts',$posts);
			
			
			// $post_model = new Post();
			// $posts = $post_model->limit(10)->all(true);
			// 
			// foreach ($posts as $post) {
			// //	echo $post->id;
			// //	echo ',';
			// }
			
			//$this->render_text('');
			//$posts = $post_model->where('id IN (?)',array(array(1,2)))->all();
			//$ids = array(1,2);
			//$posts = $post_model->where('id IN (:in)',array('in' => $ids))->all();
		
			//$post_model->where(array('id' => array(1,2,3)));
			
		//	$posts = $post_model->where(array('id' => $ids))->to_sql();
			
			//$posts = $post_model->where('name = "danillo"')->where('deleted = ?',array(1))->order('id DESC')->to_sql();
			
			//$post_model->where(array('name = ?',array('danillo')));
			
			//$post_model->where(array('name' => 'danillo'));
			//$posts = $post_model->get_column_names();
			//print_r($posts);
		}
		
		
		function inserts() {
			$post = new Post();
			$post->create(array('title'=>'Create 1','content'=>'danillo'));
			echo $post->title;
			$this->render_text($post->id);
		}
		
		public function increment_decrement() {
			$post = new Post();
			
			echo $post->decrement(1,'comments_count');
			$this->render_text('a');
			
		}
		
		public function hooks() {
			
			$post = new Post();
			$post->title = 'Teste Hook';
			$post->save();
			
			$post = new Post();
			$post->title = 'Teste Hook';
			$post->save();
			$post->title = 'Teste Hook update';
			$post->save();
			
			$post->where(array('id'=>array($post->id, $post->id-1)))->delete_all();
			
			$this->render_text('Hooks tests');
		}
		
	}
	

?>