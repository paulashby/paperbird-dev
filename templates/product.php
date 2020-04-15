<?php 
	$out = "<div>";
 
    $dsc = $page->product_shot->description;
	$alt_text = $dsc ? $dsc : $page->title;

	$out .= "<img src='" . $page->product_shot->size(200,0)->url . "' alt='" . $alt_text . "'>
		<p>" . $page->product_code . "</p>
		</div>";
		
	return $out;