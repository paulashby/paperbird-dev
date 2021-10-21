<?php namespace ProcessWire;

$artist_name = $page->title;
$title = $page->title;

echo "<main data-pw-id='main'>
	<h1 class='page-title'>$title</h1>
	<div class='products'>
		<div class='card-viewer' data-action='closeLightbox'></div>
	</div>
	<div id='blog-loader'></div>
</main>";