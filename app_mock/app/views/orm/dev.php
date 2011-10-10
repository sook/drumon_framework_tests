<?php
	//print_r($posts);
	//echo count($posts);
	
	foreach ($posts as $post) {
		
		echo '<br>';
		echo $post['id'];
		
	}

	echo $paginate->show($posts);

?>