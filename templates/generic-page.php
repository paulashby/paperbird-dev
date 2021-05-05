<?php namespace ProcessWire;

$content = $page->page_content;
$title = $page->title;
echo "<main data-pw-id='main' class='generic-page'>
	<h1 class='page-title'>$title</h1>
	$content
</main>";
?>