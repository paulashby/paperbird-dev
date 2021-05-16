<?php namespace ProcessWire;

$random_image_url = $page->image->getRandom()->url;
echo "<main data-pw-id='main'>
	<h1 class='page-title page-title--home'>Welcome to paperbird</h1>
	<img src='$random_image_url' class='home-image--mob'>
</main>";
?>
