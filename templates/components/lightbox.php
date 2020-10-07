<?php namespace ProcessWire;

$lightbox_inner = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$lightbox_inner .= "<div class='active-card'>";

$product_page = $pages->get("sku=$sku");
$lightbox_inner.= $cart->renderItem($product_page);

$lightbox_inner .= "<p class='lightbox__size'>XXX x XXXmm";
$lightbox_inner .= "<p class='lightbox__paperspec'>XXXgsm uncoated</p>";
$lightbox_inner .= "<p>Do we want fields for size and paper stock? Or do we base the former on the price category and the latter just a site-wide setting?</p>
</div><!-- End active-card -->";

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

