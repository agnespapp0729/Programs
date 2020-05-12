<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Page access is forbidden!</h1>
	Permission check: <?=isset($_SESSION['permission']) ? $_SESSION['permission'] : "You don't have a permission!" ?>
<?php else : ?>
	<h1>Access allowed</h1>
	<p>Your permission level is <?=$_SESSION['permission'] ?></p>
	<?php switch ($_SESSION['permission']) {
		case '0':
			echo "Szét tud nézni a könyvek között.";
			break;
		case '1':
			echo "Akár hozzá is tud adni egy újat.";
			break;
		case '2':
			echo "Szerkesztheti a felhasználók adatait és törölni is tud.";
			break;
		default:
			echo "Keresgélhet, hozzá is adhat. Ezen kívül szerkesztheti a felhasználók adatait és törölheti is őket.";
			break;
	} ?>
<?php endif; ?>