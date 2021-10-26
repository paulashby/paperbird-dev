<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing"; }

// Listings images open the lightbox when clicked, cart images don't
if( ! array_key_exists("product_data_attributes", $product_shot_options)) {
	$product_shot_options["product_data_attributes"] = "";	
}

$img_index = isset($product_shot_options["img_index"]) ? $product_shot_options["img_index"] : 0;
$product = $product_shot_options["product"];
$product_w = $product->product_shot->first()->width();
$product_h = $product->product_shot->first()->height();
$product_shot_options["class"] .= " " . $product->parent->name;
if( ! $product->packshot){
	$product_shot_options["class"] .= " keyline";
}
if($product_w != $product_h){
	$product_shot_options["class"] .= " rect";

	if($product_w > $product_h)
	{	
		$product_shot_options["class"] .= " rect--l";
	} else {
		$product_shot_options["class"] .= " rect--p";
	}	
} else {
	$product_shot_options["class"] .= " sq";
}

$product_shot = $product->product_shot->eq($img_index);
$dsc = $product_shot->description;
$alt_str = $dsc ? $dsc : $product->title;

$product_shot_options["alt_str"] = $alt_str;
$product_shot_options["image"] = $product_shot;
$product_shot_options["webp"] = true;

$lazyImages = $product_shot_options["lazyImages"];

return $lazyImages->renderImage($product_shot_options);