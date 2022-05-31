<?php namespace ProcessWire;

//TODO: Do we actually need context?
if( ! isset($context)){ $context = "listing";}

$product = $product_shot_options["product"];
$sku = $product->sku;
$pg_template = $page->template->name;
$data_attr_String = $pg_template == "category-main" ? "" : "data-action='openLightbox' data-sku='$sku'";

$image_format_class = get_image_format_class($product->product_shot->first());

$entry_out = "<div class='products__product $image_format_class' $data_attr_String>";

$product_shot_options["product_data_attributes"] = $data_attr_String;
$product_shot_markup = $this->files->render("components/productImage", Array("product_shot_options"=>$product_shot_options));

$entry_out .= $product_shot_markup;

$product_title_sku_options = [
	"product"=>$product,
	"data_attr_String"=>$data_attr_String
];

$entry_out .= $this->files->render("components/productTitleSku", $product_title_sku_options);
$entry_out .= "</div><!-- End Products__product -->";

return $entry_out;