<hr>

<a href="index.php">Home</a>
<?php if(!IsUserLoggedIn()) : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=login">Login</a>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=register">Register</a>
<?php else : ?>
	<span> &nbsp; | &nbsp; </span>
	<a href="index.php?P=test">Permission test</a>
	<span> &nbsp; || &nbsp; </span>
	<a href="index.php?P=list_book">Book list</a>

	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
		<span> &nbsp; | &nbsp; </span>
		<a href="index.php?P=add_book">Add a book</a>
		<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] > 1) : ?>
			<span> &nbsp; | &nbsp; </span>
			<a href="index.php?P=users">User list</a>
		<?php endif; ?>	
	<?php endif; ?>
	<span> &nbsp; || &nbsp; </span>
	<a href="index.php?P=logout">Logout</a>
<?php endif; ?>

<hr>