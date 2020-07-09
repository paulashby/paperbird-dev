<?php namespace ProcessWire;

$out = "<div>";

$dsc = $page->product_shot->description;
$alt_text = $dsc ? $dsc : $page->title;
$sku = $page->sku;

$out .= "<img src='" . $page->product_shot->size(200,0)->url . "' alt='" . $alt_text . "'>
	<p>$sku</p>
	</div>";
	
return $out;