<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

if( $config->ajax) {

	// Lightbox interaction

	$sku = $input->get("sku", "text");

	if($sku) {

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
$product_list = "";

// Cart image sizes not included in LazyResponsiveImages config - just listings and lightbox.

$lazyImages = $modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("subcat");
$eager_count = 0;

foreach ($products as $product) {

	$listing_options = [
		"sub_cat"=>true,
		"lazyImages"=>$lazyImages,
		"product"=>$product,
		"field_name"=>"product_shot",
		"context"=>"listing",
		"desktop_hdpi"=>"200",
		"sizes"=>"(max-width: 1000px) 150px, 100px",
		"class"=>"products__product-shot"
	];

	if($eager_count < $max_eager) {

		$listing_options["lazy_load"] = false;
	} else {

		$listing_options["lazy_load"] = true;
	}

	$product_list .= $files->render('components/productListingEntry', $listing_options);

	$eager_count++;
}
echo "<main data-pw-id='main'>
		<h1 class='page-title'><span class='page-title__category'>$category</span> $title</h1>
		<section class='products'>
			<div class='card-viewer'></div>
			$product_list
		</section>
	</main>";