<?php namespace ProcessWire;

//TODO: Wrap this in a link
//TODO: Do we actually need context?
if( ! isset($context)){ $context = "listing";}

$product = $product_shot_options["subcat"];
$entry_out = "<div class='products__product'>";

$product_shot_markup = $this->files->render("components/productImage", Array("product_shot_options"=>$product_shot_options));

$entry_out .= $product_shot_markup;
$entry_out .= "<h2 class='title--subcat'>{$product->title}</h2>";
$entry_out .= "</div><!-- End Products__product -->";

return $entry_out;