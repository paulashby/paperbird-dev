<?php namespace ProcessWire;

$random_image = $page->image->getRandom();
$image_description = $random_image->description;
$alt_str = strlen($image_description) ? $image_description : "A visually delightful card";

$image_options = array(
	"image_description" => $image_description,
	"alt_str"=>$alt_str,
	"class"=>"home-image--mob",
	"context"=>"home",
	"field_name"=>"image",
	"image"=>$random_image,
	"product_data_attributes"=>"",
	"sizes"=>"(min-width: 500px) 400px, 80vww",
	"lazy_load"=>false,
	"webp"=>true
);

$lazyImages = $modules->get("LazyResponsiveImages");
$main_image = $lazyImages->renderImage($image_options);

echo "<main data-pw-id='main'>
	<h1 class='page-title page-title--home'>Welcome to paperbird</h1>
	$main_image
</main>";

?>
