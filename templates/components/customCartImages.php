<?php namespace ProcessWire;

/**
* Generate custom image markup for OrderCart module
*
* @param Processwire Page $product
* @param Int $img_count
* @param Boolean $eager - override lazy loading
* 
* @return String HTML markup
*/

$lazyImages = $this->modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("cart");
// lazy loading not required if $eager is true
$lazy_load = !$eager && $img_count > $max_eager;

$listing_options = [
	"lazyImages"=>$lazyImages,
    "product"=>$product,
    "field_name"=>"product_shot",
    "sizes"=>"(max-width: 1000px) 150px, 100px",
    "class"=>"cart__product-shot",
    "lazy_load"=>$lazy_load
];

return $this->files->render("components/productImage", $listing_options);