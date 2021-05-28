<?php namespace ProcessWire;

/**
* Generate custom image markup for OrderCart module
*
* @param Processwire Page $product
* @param Int $img_count // img_count > $max_eager will lazy load, unless overriden...
* @param Boolean $eager - override lazy loading
* @param Int $img_index - index of image to use from ProcessWire image field
* 
* @return String HTML markup
*/

$lazyImages = $this->modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("cart");
// lazy loading not required if $eager is true
$lazy_load = !$eager && $img_count > $max_eager;
$img_index = isset($img_index) ? $img_index : 0;

$class = isset($class) ? $class : "cart__product-shot";

$listing_options = [
	"lazyImages"=>$lazyImages,
    "product"=>$product,
    "field_name"=>"product_shot",
    "sizes"=>"(max-width: 1000px) 150px, 100px",
    "class"=>$class,
    "lazy_load"=>$lazy_load,
    "context"=>"cart",
    "img_index"=>$img_index
];

return $this->files->render("components/productImage", Array("product_shot_options"=>$listing_options));