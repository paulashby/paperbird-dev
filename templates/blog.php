<?php namespace ProcessWire;

$title = $page->title;
// $sketch_title = $random_entry->title;
// $sketch_url = $random_entry->image->first()->size(400)->url;
// $reload_url = $page->url;
// $caption = $random_entry->sketchbook_caption;

echo "<main data-pw-id='main' class='generic-page'>
	<h1 class='page-title'>$title</h1>
	<div class='blog-content'>
	</div>
	<div id='blog-loader'></div>
</main>";
?>