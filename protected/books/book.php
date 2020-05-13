<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 0) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
	<?php 
		$query = "SELECT id, book_title, length, difficulty, category, description, rating FROM books WHERE id = :id";
		require_once DATABASE_CONTROLLER;
		$params = [':id' => $_GET['id']];
		$books = getList($query, $params);
	?>

	<?php foreach ($books as $b) : ?>
		<h1> <?=$b['book_title']?></h1>
		<h5><?=$b['category']?></h5>
		<?= $b['difficulty'] == 1 ? 'Very Easy' : ($b['difficulty'] == 2 ? 'Easy' : ($b['difficulty'] == 3 ? 'Medium' : ($b['difficulty'] == 4 ? 'Hard' : 'Very Hard')));?> 
		 <?=$b['length']?>
		<hr style="width: 75%">
		<h4>Description</h4>
		<pre><?=$b['description']?></pre>
	<?php endforeach; ?>
<?php endif; ?>