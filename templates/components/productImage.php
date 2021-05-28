<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing"; }

// Listings images open the lightbox when clicked, cart images don't
if( ! array_key_exists("product_data_attributes", $product_shot_options)) {
	$product_shot_options["product_data_attributes"] = "";	
}

$product = $product_shot_options["product"];
$img_index = isset($product_shot_options["img_index"]) ? $product_shot_options["img_index"] : 0;

$product_shot = $product->product_shot->eq($img_index);
$dsc = $product_shot->description;
$alt_str = $dsc ? $dsc : $product->title;

$product_shot_options["alt_str"] = $alt_str;
$product_shot_options["image"] = $product_shot;
$product_shot_options["webp"] = true;

$lazyImages = $product_shot_options["lazyImages"];

return $lazyImages->renderImage($product_shot_options);