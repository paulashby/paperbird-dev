<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing";}

$sku = $product->sku;
$data_attr_String = "data-action='openLightbox' data-sku='$sku'";

$entry_out = "<div class='products__product' $data_attr_String>";

$product_shot_options = [
	"class"=>$class,
	"context"=>$context,
	"data_attr_String"=>$data_attr_String,
	"field_name"=>$field_name,
	"product"=>$product,
	"lazy_load"=>$lazy_load,
	"lazyImages"=>$lazyImages,
	"sizes"=>$sizes
];
$product_shot_markup = $this->files->render("components/productImage", $product_shot_options);
$entry_out .= $product_shot_markup;

$product_title_sku_options = [
	"product"=>$product,
	"data_attr_String"=>$data_attr_String
];
$entry_out .= $this->files->render("components/productTitleSku", $product_title_sku_options);

return $entry_out;