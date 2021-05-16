<?php namespace ProcessWire;

$random_image = $page->image->getRandom();
$random_image_url = $random_image->url;
$webp_url = $random_image->webp->url;

/*
See Notes/Webp In Processwire.txt

Uncomment the following to confirm it's working (this will output the 260px version and at that size, the webp is the smaller of the two, so does get output).
*/
// $smaller_version = $random_image->size(260);
// $webp_url = $smaller_version->webp->url;
// $random_image_url = $smaller_version->url;


echo "<main data-pw-id='main'>
	<h1 class='page-title page-title--home'>Welcome to paperbird</h1>
	<picture>
	  <source srcset='$webp_url' type='image/webp' class='home-image--mob'>
	  <img src='$random_image_url' class='home-image--mob'>
	 </picture>
</main>";

?>
