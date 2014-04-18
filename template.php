<?
/*
** Merge page variables with defaults
*/
$defaults = array(
	'page_title' => ''
,	'prev_url'   => ''
,	'next_url'   => ''
,	'bg_color'   => '#FFFFFF'
);

$vars = array_merge($defaults, $page_settings);

/*
** Filename translation
*/
$filename = explode('.', basename($_SERVER['PHP_SELF']));
$filename = $filename[0]; // No file extension

if (!$vars['page_title']) {
	// Double dashes to arrow
	$file_title = str_replace('--', ' &raquo; ', $filename);
	// Dashes to spaces
	$file_title = str_replace('-', ' ', $file_title);
	// Capitalize first letters
	$file_title = ucwords($file_title);

	$vars['page_title'] = $file_title;
}

/*
** Navigation generation
*/
if (!$vars['prev_url'] || !$vars['next_url']) {

	$files = glob("*.php");
	foreach ($files as $key => $fn) {

		// Ignore core files
		if ($fn == 'template.php' || $fn == 'index.php')
			unset($files[$key]);
	}
	// Reset array keys
	$files = array_values($files);

	foreach ($files as $key => $fn) {

		// Find this page
		if ($fn == $filename.'.php')
			$this_key = $key;
	}

	// Set previous and next urls
	if (!$vars['prev_url'] && $this_key != 0)
		$vars['prev_url'] = $files[$this_key - 1];
	if (!$vars['next_url'] && $this_key != count($files)-1)
		$vars['next_url'] = $files[$this_key + 1];

}

/*
** Image details
*/
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

	<title><?= $vars['page_title'] ?></title>

	<style type="text/css">
	* {
		margin: 0;
		padding: 0;
	}
	body {
		background-color: <?= ($vars['bg_color']) ? $vars['bg_color'] : '#FFFFFF' ?>;
		background-image: url(<?= $filename ?>.jpg);
		background-position: center top;
		background-repeat: no-repeat;
		height: <?= $height ?>px;
	}
	nav a {
		display: block;
		width: 50%;
		position: fixed;
		top: 0;
		bottom: 0;
	}
	nav a.prev {
		left: 0;
	}
	nav a.next {
		right: 0;
	}
	</style>

</head>

<body>
<nav>
<?
if ($vars['prev_url']) { echo '<a href="'.$vars['prev_url'].'" class="prev"></a>'; }
if ($vars['next_url']) { echo '<a href="'.$vars['next_url'].'" class="next"></a>'; }
?>
</nav>
</body>

</html>
