<?php namespace ProcessWire;

$lightbox_inner = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$lightbox_inner .= "<div class='active-card'>";

$product_page = $pages->get("sku=$sku");
$settings = $this->modules->get("ProcessOrderPages");

$product_details = $product_page->price_category;
$price = $cart->renderPrice($product_details->price);
$size = $product_details->size;
$paper_spec = $product_details->paper->paper_spec;
$lightbox_extras = array();

if($user->isLoggedin()) {
	$lightbox_extras["price"] = $cart->renderPrice($product_details->price);
}

// Include any fields specific to this project
$lightbox_extras["size"] = $product_details->size . "mm";
$lightbox_extras["paperspec"] = $product_details->paper->paper_spec;

$lightbox_inner.= $cart->renderItem($product_page, "lightbox", $lightbox_extras);

$lightbox_inner .= "</div><!-- End active-card -->";

$lightbox_class = "lightbox";

if(count($product_page->variations)){

	$lightbox_class .= " lightbox--has-variations";
	$lightbox_inner .= "<div class='lightbox__extras'><h2 class='lightbox__variations-title'>Variations</h2>
	<ul class='lightbox__variations'>";

	foreach ($product_page->variations as $product) {

		$product_shot_options = array(
			"product"=>$product,
			"field_name"=>"product_shot",
			"class"	=>"lightbox__variation-img",
			"alt_str"=>$product->title,
			"context"=>"lightbox_variation",
			"image" =>$product->product_shot->first(),
			"product_data_attributes"=>"data-action='showProduct' data-sku='$product->sku'",
			"sizes"=>"130px",
			"lazyImages"=>$modules->get("LazyResponsiveImages"),
			"lazy_load"=>false,
			"webp"=>true
		);

		$product_image = $files->render("components/productImage", array("product_shot_options"=>$product_shot_options));

		$lightbox_inner .= "<li class='lightbox__variation'>$product_image</li>";
	}
	$lightbox_inner .= "</ul>
	</div><!-- END lightbox__extras -->";
}

$lightbox = "<section class='$lightbox_class'>$lightbox_inner</section>";

return $lightbox;

