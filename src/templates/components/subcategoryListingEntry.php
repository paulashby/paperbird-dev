<?php namespace ProcessWire;

if( ! isset($context)){ $context = "listing";}

$product = $product_shot_options["subcat"];
$product_url = $product->url;

$image_format_class = get_image_format_class($product->category_image_page->product_shot->first());

$entry_out = "<div class='products__product $image_format_class'>
<a href='$product_url' class='subcat-link'>";

$product_shot_markup = $this->files->render("components/productImage", Array("product_shot_options"=>$product_shot_options));

$entry_out .= $product_shot_markup;
$entry_out .= "<h2 class='title--subcat'>{$product->title}</h2>
</a>
</div><!-- End Products__product -->";

return $entry_out;