<?php namespace ProcessWire;

/**
* Generate custom image markup for OrderCart module
*
* @param Processwire Page $product
* @param Int $img_count // img_count > $max_eager will lazy load, unless overriden...
* @param Boolean $eager - override lazy loading
* @param Int $img_index - index of image to use from ProcessWire image field
* @param String $context - where are images used
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
    // See Notes/SrcSet Planning.txt
    "sizes"=>"(min-width: 1070px) 116px, (min-width: 815px) 13.5vw, (min-width: 650px) 16vw, (min-width: 550px) 19vw, (min-width: 400px) 27vw, 32vww",
    "class"=>$class,
    "lazy_load"=>$lazy_load,
    "context"=>"cart",
    "img_index"=>$img_index
];

if(isset($context) && $context === "lightbox") {
    $listing_options["sizes"] = "(min-width: 650px) 375px, (min-width: 400px) 280px, (min-width: 320px) 70vw, 225px";
}

return $this->files->render("components/productImage", Array("product_shot_options"=>$listing_options));