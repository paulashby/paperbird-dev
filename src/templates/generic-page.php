<?php namespace ProcessWire;

$page_class = $page->name;
$title = $page->title;
$content = $page->page_content;

if($page_class == "whats-on" || $page_class == "notebook"){
	
	$content = "";
	$entries = $page->children();

	foreach ($entries as $entry) {

		$post_content = $entry->page_content;
		$story_details = $entry->story_details;
		if($story_details){
			$story_details = "<div class='story__details'>$story_details</div>";
		}

		$product = $entry->biography_card;
		$post_image = "";
	 	if($product) {
	 		// Post uses image from existing product
	 		$post_image = getEventImage($product->product_shot->first(), $entry->title);
	 	} else {
	 		// Post has its own image
	 		$img = $entry->image;
			if($img->count()){
				$post_image = getEventImage($img->first(), $title);
			}
	 	}

		$content .= "<div class='event-entry'>$post_image<div class='event-entry__text'><h2>$entry->title</h2>{$post_content}{$story_details}</div></div><!-- END event-entry -->";
	}
}
echo "<main data-pw-id='main' class='generic-page generic-page--$page_class'>
	<h1 class='page-title'>$title</h1>
	<div class='gp__content gp__content--show'>$content</div>
</main>";

function getEventImage ($image, $title) {

	$image_description = $image->description;
	$alt_str = strlen($image_description) ? $image_description : $title;

	$image_options = array(
		"alt_str"=>$alt_str,
		"class"=>"event-entry__image",
		"context"=>"whatson",
		"field_name"=>"image",
		"image"=>$image,
		"product_data_attributes"=>"",
		"sizes"=>"(min-width: 650px) 37vw, (min-width: 1200px) 450px, 75vww",
		"lazy_load"=>false,
		"webp"=>true
	);

	$lazyImages = wire("modules")->get("LazyResponsiveImages");
	return $lazyImages->renderImage($image_options);
}
?>
