<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

if( $config->ajax) {

	// Lightbox interaction

	$sku = $input->get("sku", "text");

	if($sku && $user->isLoggedin()) {

		// Get lightbox markup
		$lightbox = $files->render('components/lightbox', ['sku'=>$sku, 'cart'=>$cart, 'action'=>'toggleMenuDisplay']);	

		return json_encode(array("success"=>true, "data"=>$lightbox));

	} else {

		return json_encode(array("success"=>false, "error"=>"Users must be logged in to use the cart"));
	}

}

$category = $page->parent->title;
$title = $page->title;
$products = $page->children();
$products_out = "";
$size = $cart->getProductShotSize(true);

foreach ($products as $product) {
	$product_shot = $product->product_shot->first();
	$product_shot_url = $product_shot->size($size, $size)->url;
	$dsc = $product_shot->description;
	$alt_text = $dsc ? $dsc : $product->title;
	$sku = $product->sku;
	$product_title = $product->title;
	$products_out .= "<div class='product' data-action='toggleLightbox' data-sku='$sku'><img src='$product_shot_url' alt='$alt_text'><p>$sku</p><h2>$product_title</h2></div>";
}
echo "<main data-pw-id='main'>
	<h1>$category $title</h1>
	<div class='card-viewer'></div>
	$products_out
	</main>";