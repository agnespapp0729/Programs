<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
		$postData = [
			'id' => $postData['id'],
			'book_title' => $_POST['book_title'],
			'length' => $_POST['length'],
			'difficulty' => $_POST['difficulty'],
			'category' => $_POST['category'],
			'description' => $_POST['description'],
			'rating' => $_POST['rating']
		];

		if(empty($postData['book_title']) || empty($postData['length']) || empty($postData['difficulty']) || empty($postData['category']) || empty($postData['description']) || empty($postData['rating'])) {
			echo "Hiányzó adat(ok)!";
		} else {
			$query = "UPDATE books SET book_title = :book_title, length = :length, difficulty= :difficulty, 
			category= :category, description= :description, rating= :rating  WHERE id = :id";
			$params = [
				':id' => $postData['id'],
				':book_title' => $postData['book_title'],
				':length' => $postData['length'],
				':difficulty' => $postData['difficulty'],
				':category' => $postData['category'],
				':description' => $postData['description'],
				':rating' => $postData['rating']
				];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}

	
	$query2 = "SELECT id, book_title, length, difficulty, category, description, rating FROM books WHERE id = :id ";
	$params2 = [':id' => $_GET['e']];
	require_once DATABASE_CONTROLLER;
	$books = getList($query2, $params2);
	?>
	
<?php foreach ($books as $b) : ?>
	<form method="post">
		<input type="hidden" name = "id" value="<?=$b['id']?>">

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="book_title">Book Title</label>
				<input type="text" class="form-control" id="book_title" name="book_title" value = "<?=$b['book_title']?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="length">Length</label>
				<input type="text" class="form-control" id="length" name="length" value = "<?=$b['length']?>">
			</div>
		</div>

		<div class="form-row">
                <div class="form-group col-md-6">
                    <label for="difficulty">Difficulty</label>
                    <?php
                        $select = array("There is nothing here", "Very Easy", "Easy", "Medium", "Hard", "Very Hard");
                        $fromwhere = $r['difficulty']
                    ?>

                    <select class="form-control" id="difficulty" name="difficulty">
                        <<option value="0">There is nothing here</option>
                        <?php for ($i=1; $i < $fromwhere; $i++):?>
                            <option value="<?=$select[$i]?>"><?=$select[$i]?></option>
                          <?php endfor; ?>
                          <option value="<?=$select[$fromwhere]?>" selected><?=$select[$fromwhere]?></option>
                          <?php for ($i=$fromwhere; $i < count($select); $i++):?>
                            <option value="<?=$select[$i]?>"><?=$select[$i]?></option>
                          <?php endfor; ?>

                    </select>
                  </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category">Category</label>
                    <?php
                        $fromwhere = 0;
                        $select = array("There is nothing here", "Fantasy", "Horror", "Thriller", "Kids", "Romantic", "History", "Cooking", "Information Technology", "Literature", "Arts and Music", "Biography" );
                    ?>
                    <?php switch($r['category']){
                            case "Fantasy": $fromwhere = 1; break;
                            case "Horror": $fromwhere = 2; break;
                            case "Thriller": $fromwhere = 3; break;
                            case "Kids": $fromwhere = 4; break;
                            case "Romantic": $fromwhere = 5; break;
                            case "History": $fromwhere = 6; break;
                            case "Information Technology": $fromwhere = 7; break;
                            case "Literature": $fromwhere = 8; break;
                            case "Arts and Music": $fromwhere = 9; break;
                            case "Biography": $fromwhere = 10; break;
                            default: $fromwhere = 0; break;
                    } ?>

                    <select class="form-control" id="category" name="category">
                        <option value="0">There is nothing here</option>
                        <?php for ($i=1; $i < $fromwhere; $i++):?>
                            <option value="<?=$select[$i]?>"><?=$select[$i]?></option>
                          <?php endfor; ?>
                          <option value="<?=$select[$fromwhere]?>" selected><?=$select[$fromwhere]?></option>
                          <?php for ($i=$fromwhere; $i < count($select); $i++):?>
                            <option value="<?=$select[$i]?>"><?=$select[$i]?></option>
                          <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
			<div class="form-group col-md-6">
				<label for="rating">Rating</label>
				<input type="text" class="form-control" id="rating" name="rating" value = "<?=$b['rating']?>">
			</div>
		</div>
		
		<button type="submit" class="btn btn-primary" name="edit">Save changes</button>
	</form>
	<?php endforeach;?>
<?php endif; ?>