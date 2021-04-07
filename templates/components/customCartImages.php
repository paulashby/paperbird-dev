<?php namespace ProcessWire;

// Expects $product and $img_count vars

$lazyImages = $this->modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("cart");
$lazy_load = $img_count > $max_eager;

$listing_options = [
	"lazyImages"=>$lazyImages,
    "product"=>$product,
    "field_name"=>"product_shot",
    "sizes"=>"(max-width: 1000px) 150px, 100px",
    "class"=>"cart__product-shot",
    "lazy_load"=>$lazy_load
];

return $this->files->render("components/productImage", $listing_options);