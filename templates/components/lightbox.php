<?php namespace ProcessWire;

$lightbox_inner = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$lightbox_inner .= "<div class='active-card'>";

$product_page = $pages->get("sku=$sku");
$settings = $this->modules->get("ProcessOrderPages");

$product_details = $product_page->price_category;
$price = $cart->renderPrice($product_details->price);
$size = $product_details->size;
$paper_spec = $product_details->paper->paper_spec;

$lightbox_inner.= $cart->renderItem($product_page);

$lightbox_inner .= "<p class='lightbox__price'>$price</p>";
$lightbox_inner .= "<p class='lightbox__size'>{$size}mm</p>";
$lightbox_inner .= "<p class='lightbox__paperspec'>$paper_spec</p>";
$lightbox_inner .= "</div><!-- End active-card -->";

$lightbox_class = "lightbox";

if(count($product_page->variations)){

	$lightbox_class .= " lightbox--has-variations";

	$lightbox_inner .= "<ul class='lightbox__variations'>";

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

