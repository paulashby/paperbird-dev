<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page->title; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo $config->urls->templates?>styles/main.css" />
	</head>
	<body>
	<?php
		$title = $page->title;
		echo "<main data-pw-id='main'>
			<h1 class='page-title'>$title</h1>
		</main>";
	?>
	</body>
</html>
