<?php namespace ProcessWire;

$entries = $page->children;
$random_entry = $entries->getRandom();
$title = $page->title;
$sketch_title = $random_entry->title;
$sketch_url = $random_entry->image->first()->size(400)->url;
$caption = $random_entry->sketchbook_caption;

echo "<main data-pw-id='main'>
	<h1 class='page-title'>$title</h1>
	<img  class='sketchbook-image' src='$sketch_url'>
	<h2 class='sketch-title'>$sketch_title</h2>
	<p class='sketchbook-caption'>$caption</p>
</main>";
?>