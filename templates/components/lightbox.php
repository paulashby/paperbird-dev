<?php namespace ProcessWire;

$lightbox = "<div class='lightbox'>";
$lightbox .= $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close toggle__button--lightbg', 'action'=>'closeLightbox']);
$product_page = $pages->get("sku=$sku");
$lightbox .= $cart->renderItem($product_page);
$lightbox .= "<p class='lightbox__size'>XXX x XXXmm";
$lightbox .= "<p class='lightbox__paperspec'>XXXgsm uncoated</p>";
$lightbox .= "<p>Do we want fields for size and paper stock? Or do we base the former on the price category and the latter just a site-wide setting?</p>";

$lightbox .= "<div class='lightbox__variations'>";

foreach ($product_page->variation as $product) {
	$p_url = $product->url;
	$product_shot = $product->product_shot;
	$size = 60;
	$product_shot_url = $product_shot->first()->size($size, $size)->url;
	$dsc = $product_shot->description;
	$alt_text = $dsc ? $dsc : $product->title;

	//TODO: We actually want to load variation pages into the lightbox rather than loading  pages
	$lightbox .= "<a href='$p_url' class='lightbox__variation'><img class='lightbox__variation-img' src='$product_shot_url' alt='$alt_text'></a>";
}
$lightbox .= "</div>
</div>";

return $lightbox;

