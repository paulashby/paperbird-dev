<?php namespace ProcessWire;

$product_shot = $product->product_shot->first();
	$sku = $product->sku;
	$product_title = $product->title;
	$dsc = $product_shot->description;
	$alt_str = $dsc ? $dsc : $product_title;
	$data_attr_String = "data-action='openLightbox' data-sku='$sku'";

	$entry_out = "<div class='products__product' $data_attr_String>";

	$product_shot_options = [
		"image"=>$product_shot,
		"field_name"=>$field_name,
		"context"=>$context,
		/* Specify any desktop hdpi images (retina) - considering all mobile images hdpi.
		Comma-delimited if mutliple.
		This will need more work if a given image width is both hdpi and mdpi for different screen widths
		*/
		"product_data_attributes"=>$data_attr_String,
		"desktop_hdpi"=>$desktop_hdpi,
		"sizes"=>$sizes,
		"alt_str"=>$alt_str,
		"class"=>$class,
		"lazy_load"=>$lazy_load
	];
	$product_shot_markup = $lazyImages->renderImage($product_shot_options);
	
	$entry_out .= $product_shot_markup;
	$entry_out .= "<p class='products__sku' $data_attr_String>$sku</p>
		<h2 class='products__title' $data_attr_String>$product_title</h2>
	</div>";

	return $entry_out;