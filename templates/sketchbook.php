<?php namespace ProcessWire;

$entries = $page->children;
$random_entry = $entries->getRandom();
$title = $page->title;
$sketch_title = $random_entry->title;
$sketch_url = $random_entry->image->first()->size(400)->url;
$reload_url = $page->url;
$caption = $random_entry->sketchbook_caption;

echo "<main data-pw-id='main' class='generic-page'>
	<h1 class='page-title'>$title</h1>
	<img  class='sketchbook-image' src='$sketch_url'>
	<h2 class='sketch-title'>$sketch_title</h2>
	<p class='sketchbook-caption'>$caption</p>
	<p class='footnote'><a href='$reload_url' class='footnote__link'>Show me another</a></p>
</main>";
?>