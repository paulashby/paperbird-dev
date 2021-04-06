<?php namespace ProcessWire;

$lightbox_inner = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$lightbox_inner .= "<div class='lightbox_message'><p class='lightbox_message-text'><span class='lightbox_message-content'>Added to cart</span></p></div>";
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

$lightbox_inner.= $cart->renderItem($product_page, $lightbox_extras);

$lightbox_inner .= "</div><!-- End active-card -->";

$lightbox_class = "lightbox";

if(count($product_page->variations)){

	$lightbox_class .= " lightbox--has-variations";
	$lightbox_inner .= "<h2 class='lightbox__variations-title'>Variations</h2>
	<ul class='lightbox__variations'>";

	foreach ($product_page->variations as $product) {
		$p_sku = $product->sku;
		$product_shot = $product->product_shot;
		$size = 80;
		$product_shot_url = $product_shot->first()->size($size, $size)->url;
		$dsc = $product_shot->description;
		$alt_text = $dsc ? $dsc : $product->title;

		$lightbox_inner .= "<li class='lightbox__variation'><img class='lightbox__variation-img' src='$product_shot_url' alt='$alt_text' data-action='showProduct' data-sku='$p_sku'></li>";
	}
	$lightbox_inner .= "</ul>";
}

$lightbox = "<section class='$lightbox_class'>$lightbox_inner</section>";

return $lightbox;

