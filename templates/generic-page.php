<?php namespace ProcessWire;

$page_class = $page->name;
$title = $page->title;
$content = $page->page_content;

if($page_class == "whats-on" || $page_class == "notebook"){
	
	$content = "";
	$entries = $page->children();

	foreach ($entries as $entry) {
		$entry_image = "";
		$img = $entry->image;
		if($img->count()){
			$entry_image = getEventImage($img->first(), $title);
		}
		$content .= "<div class='event-entry'>$entry_image<h2>$entry->title</h2>$entry->page_content</div><!-- END event-entry -->";
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
