<?php namespace ProcessWire;

/*
Render using $page->renderValue($value, 'nameOfThisTemplate') 
See https://processwire.com/api/ref/page/render-value/

Need to make sure we add the right number of dots under the slider images - and work out how to implement their links.

*/

define("IMAGE_WIDTH", 240);

$num_entries = $value->count;
$curr_entry = 0;
$out = "<div class='slider'>
<div class='slider__control--block'>
	<a class='slider__control--block slider__control-bttn--left' href='#'>&lt;</a>
	<a class='slider__control--block slider__control-bttn--right' href='#'>&gt;</a>
</div>";


foreach ($value as $entry) {
	
	$out .= "<div id='slide-{$curr_entry}'>
		<h3>{$entry->title}</h3>";

	$out .= getImage($entry);

	$out .= "<p class='slider__control--inline'>";
		
	for ($i=0; $i < $num_entries; $i++) { 
		$out .= getJumpLink($i === $curr_entry, $i);
	}
		
	$out .= "</p>
	<p class='slider__biography'>" . $entry->biography . "</p>
	</div>";

	$curr_entry++;

}

return $out . "</div>";



function getJumpLink ($active, $id_num) {

	$dot_class = $active ? "slider__control--block slider__control-dot--active" : "slider__control--block slider__control-dot";

	// Link uses jump links like this: https://css-tricks.com/can-get-pretty-far-making-slider-just-html-css/
	$link = "#slide-" . $id_num;

	return "<a class='{$dot_class}' href='{$link}'>&bull;</a>";

}
function getImage ($entry) {

	$entry_image = $entry->biography_card->product_shot;
	$image_description = $entry_image->description;
	$image_description_fallback = $entry->biography_card->title;
	$alt_string = $image_description ? $image_description : $image_description_fallback;

	return "<img src='" . $entry_image->size(IMAGE_WIDTH,0)->url . "' alt='" . $alt_string . "'>";
}
