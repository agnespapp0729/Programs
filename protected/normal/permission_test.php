<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
	Permission check: <?=isset($_SESSION['permission']) ? $_SESSION['permission'] : "You don't have a permission!" ?>
<?php else : ?>
	<h1>Access allowed</h1>
	<p>Your permission level is <?=$_SESSION['permission'] ?></p>
	<?php switch ($_SESSION['permission']) {
		case '0':
			echo "You can search for books.";
			break;
		case '1':
			echo "You can add a new one.";
			break;
		case '2':
			echo "You can edit the users profile and you can even add a user.";
			break;
		default:
			echo "All of the functions are available for you.";
			break;
	} ?>
<?php endif; ?>