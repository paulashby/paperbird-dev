<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing"; }

// Listings images open the lightbox when clicked, cart images don't
if( ! isset($data_attr_String)){ $data_attr_String = ""; }

$product_shot = $product->product_shot->first();
$dsc = $product_shot->description;
$alt_str = $dsc ? $dsc : $product->title;

$product_shot_options = [
	"alt_str"=>$alt_str,
	"class"=>$class,
	"context"=>$context,
	"field_name"=>$field_name,
	"image"=>$product_shot,
	"lazy_load"=>$lazy_load,
	"product_data_attributes"=>$data_attr_String,
	"sizes"=>$sizes
];

return $lazyImages->renderImage($product_shot_options);