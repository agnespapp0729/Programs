 <?php 
 if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
 		$query = "DELETE FROM books WHERE id = :id";
		$params = [':id' => $_GET['d']];
		require_once DATABASE_CONTROLLER;
		if(!executeDML($query, $params)) {
		echo "Hiba törlés közben!";
		}
	}
 ?>

<?php if(!isset($_SESSION['permission'])): ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>
	<?php 
		$query = "SELECT id, book_title, length, difficulty, category, rating FROM books ORDER BY book_title ASC";
		require_once DATABASE_CONTROLLER;
		$books = getList($query);
	?>

	<?php if(count($books) <= 0) : ?>
		<h1>No books found in the database.</h1>
	<?php else : ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Book Title</th>
					<th scope="col">Length</th>
					<th scope="col">Difficulty</th>
					<th scope="col">Category</th>
					<th scope="col">Rating</th>
					<?php if($_SESSION['permission'] >= 2) : ?>
						<th scope="col">Edit</th>
						<th scope="col">Delete</th>
					<?php endif; ?>
				<tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($books as $b) : ?>
					<?php $i++; ?>
					<tr>
						<th scope="row"><?=$i ?></th>
						<td><a href="<?='index.php?P=book&id='.$b['id']?>"><?=$b['book_title'] ?></a></td>
						<td><?=$b['length'] ?></td>
						<td><?=$b['difficulty'] ?></td>
						<td><?=$b['category'] ?></td>
						<td><?=$b['rating'] ?></td>
						<?php if($_SESSION['permission'] >= 2) : ?>
							<td><a href="<?='index.php?P=edit_book&e='.$b['id']?>">Edit</a></td>
							<td><a href="?P=list_book&d=<?=$b['id'] ?>">Delete</a></td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>