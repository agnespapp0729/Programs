<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
<?php else : 

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addBook'])){
			$postData = [
				'book_title' => $_POST['book_title'],
				'length' => $_POST['length'],
				'difficulty' => $_POST['difficulty'],
				'category' => $_POST['category'],
				'description' => $_POST['description'],
				'rating' => $_POST['rating']
			];



			if(empty($postData['book_title']) || empty($postData['length']) || empty($postData['difficulty']) || empty($postData['category']) || empty($postData['description']) || empty($postData['rating'])){
				echo "Hiányzó adat(ok)";
			} else {
				$query = "INSERT INTO books (book_title, length, difficulty, category, description, rating) VALUES (:book_title, :length, :difficulty, :category, :description, :rating)";
				$params = [
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
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="bookTitle">Book title</label>
				<input type="text" class="form-control" id="bookTitle" name="book_title">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="bookLength">Length</label>
				<input type="text" class="form-control" id="bookLength" name="length">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
		    	<label for="bookDifficulty">Difficulty</label>
		    	<select class="form-control" id="bookDifficulty" name="difficulty">
		    		<option value="0">There is nothing </option>
		      		<option value="1">Very easy</option>
		      		<option value="2">Easy</option>
		      		<option value="3">Medium</option>
		      		<option value="4">Hard</option>
		      		<option value="5">Very Hard</option>
		    	</select>
		  	</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="bookCategory">Category</label>
				<select class="form-control" id="bookCategory" name="category">
					<option value="0">There is nothing here</option>
		      		<option value="Fantasy">Fantasy</option>
		      		<option value="Horror">Horror</option>
		      		<option value="Thriller">Thriller</option>
		      		<option value="Kids">Kids</option>
		      		<option value="Romantic">Romantic</option>
		      		<option value="History">History</option>
		      		<option value="Cooking">Cooking</option>
		      		<option value="Information Technology">Information Technology</option>
		      		<option value="Literature">Literature</option>
		      		<option value="Arts and Music">Arts and Music</option>
		      		<option value="Biography">Biography</option>
		    	</select>
			</div>
		</div>

		<div class="form-row">
				<div class="form-group col-md-6">
					<label for="bookDescription">Description</label>
					<textarea type="text" placeholder="Please write something about it!" class="form-control" 
					id="bookDescription" name="description" rows="3"></textarea>
				</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
		    	<label for="bookRating">Rating</label>
		    	<select class="form-control" id="bookRating" name="rating">
		    		<option value="0">There is nothing </option>
		      		<option value="1">One star</option>
		      		<option value="2">Two stars</option>
		      		<option value="3">Three stars</option>
		      		<option value="4">Four stars</option>
		      		<option value="5">Five stars</option>
		    	</select>
		  	</div>
		</div>

		<button type="submit" class="btn btn-primary" name="addBook">Add a Book</button>
	</form>
<?php endif; ?>







	


	
