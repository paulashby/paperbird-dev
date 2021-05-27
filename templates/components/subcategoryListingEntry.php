<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing";}

$product = $product_shot_options["subcat"];
$product_url = $product->url;
$entry_out = "<div class='products__product'>
<a href='$product_url' class='subcat-link'>";

$product_shot_markup = $this->files->render("components/productImage", Array("product_shot_options"=>$product_shot_options));

$entry_out .= $product_shot_markup;
$entry_out .= "<h2 class='title--subcat'>{$product->title}</h2>
</a>
</div><!-- End Products__product -->";

return $entry_out;