<?php namespace ProcessWire;

$title = $page->title;

echo "<main data-pw-id='main' class='generic-page'>
	<h1 class='page-title'>$title</h1>
	<div class='blog__content'>
	</div>
	<div id='blog-loader'></div>
</main>";
?>