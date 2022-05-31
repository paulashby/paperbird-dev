<?php namespace ProcessWire;

$product_page = $pages->get("sku=$sku");
$image_format_class = get_image_format_class($product_page->product_shot->first());

$lightbox_inner = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$lightbox_inner .= "<div class='active-card $image_format_class'>";

$settings = $this->modules->get("ProcessOrderPages");

$product_details = $product_page->price_category;
$price = $cart->renderPrice($product_details->price);
$lightbox_extras = array();

if ($user->isLoggedin()) {
	$lightbox_extras["price"] = $cart->renderPrice($product_details->price);
}

// Include any fields specific to this project
$lightbox_extras["size"] = $product_details->size . "mm";
$lightbox_extras["paperspec"] = str_replace("|br-placeholder|", "<br>", $product_details->paper->paper_spec);

$cart_spec = $product_page->price_category->paper;
$unit_increment = $cart_spec->unit_increment;
if ($unit_increment != "") {
	$unit_increment = intval($unit_increment);
	$unit_descriptor = $cart_spec->unit_descriptor;
	$quantity_settings = array(
		"quantity_str" => $unit_descriptor,
		"min" => $unit_increment,
		"step" => $unit_increment
	);
} else {
	$quantity_settings = null;
}

$lightbox_inner.= $cart->renderItem($product_page, "lightbox", $lightbox_extras, $quantity_settings);
// By the time it gets to here, min and step are 3
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

