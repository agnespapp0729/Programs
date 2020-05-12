<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editUser'])) {
		$postData = [
			'id' => $_POST['id'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
		];

		if(empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['email'])) {
			echo "Hiányzó adat(ok)!";
		} else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
			echo "Hibás email formátum!";
		} else {
			$query = "UPDATE users SET first_name = :first_name, last_name = :last_name, email= :email WHERE id = :id";
			$params = [
				':id' => $postData['id'],
				':first_name' => $postData['first_name'],
				':last_name' => $postData['last_name'],
				':email' => $postData['email'],
				];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}

	
	$query2 = "SELECT id, first_name, last_name, email FROM users WHERE id = :id ";
	$params2 = [':id' => $_GET['id']];
	require_once DATABASE_CONTROLLER;
	$users = getList($query2, $params2);
	?>
	
<?php foreach ($users as $u) : ?>
	<form method="post">
		<input type="hidden" name = "id" value="<?=$u['id']?>">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name" name="first_name" value = "<?=$u['first_name']?>">
			</div>
			<div class="form-group col-md-6">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" id="last_name" name="last_name" value="<?=$u['last_name']?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" value="<?=$u['email']?>">
			</div>
		</div>

		<button type="submit" class="btn btn-primary" name="editUser">Save changes</button>
	</form>
	<?php endforeach;?>
<?php endif; ?>