<?
/*
** Image details
*/
$filename = explode('.', basename($_SERVER['PHP_SELF']));
$filename = $filename[0];
$image = getimagesize($filename.'.jpg');
$height = $image[1];

/*
** Mobile setup
*/
$is_mobile = false;
if ($image[0] < 1000) { $is_mobile = true; }
?>
<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<? if ($is_mobile) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<? endif; ?>
	<title><?= $pagetitle ?></title>
	<style type="text/css">
	* {margin:0;padding:0;}
	body {
		background-color: <?= ($bgcolor) ? $bgcolor : '#FFFFFF' ?>;
		background-image: url(<?= $filename ?>.jpg);
		background-position: center top;
		background-repeat: no-repeat;
		height: <?= $height ?>px;
	}
	nav a {
		display: block;
		position: fixed;
		top: 0;
		bottom: 0;
	}
	nav a.prev {
		left: 0;
		right: 50%;
	}
	nav a.next {
		left: 50%;
		right: 0;
	}
	</style>

</head>

<body>
<nav>
<?
if ($prevurl) { echo '<a href="'.$prevurl.'" class="prev"></a>'; }
if ($nexturl) { echo '<a href="'.$nexturl.'" class="next"></a>'; }
?>
</nav>
</body>

</html>
