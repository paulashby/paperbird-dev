<?php namespace ProcessWire;

$sku = $product->sku;
$product_title = $product->title;

// Listings entries open the lightbox when clicked, cart images don't
if( ! isset($data_attr_String)){ $data_attr_String = ""; }

return "<p class='products__sku' $data_attr_String>$sku</p>
	<h2 class='products__title' $data_attr_String>$product_title</h2>";