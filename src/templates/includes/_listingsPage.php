<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

$title = $page->title;

if( ! isset($status_message)) {
	$status_message = "";	
}
if( ! isset($search_again)) {
	$search_again = "";
}

$product_list = "";

$lazyImages = $modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("subcat");
$eager_count = 0;

foreach ($products as $product_page) {
    $product = $product_page->template->name === "proxy-page" ? $product_page->proxy : $product_page;

	$listing_options = [
		"lazyImages"=>$lazyImages,
		"product"=>$product,
		"field_name"=>"product_shot",
		"context"=>"listing",
		// See Notes/SrcSet Planning.txt
		"sizes"=>"(min-width: 1200px) 202px, (min-width: 815px) 16.85vw, (min-width: 550px) 22.8vw, 39vw",
		"class"=>"products__product-shot"
	];

	if($eager_count < $max_eager) {

		$listing_options["lazy_load"] = false;
	
	} else {

		$listing_options["lazy_load"] = true;
		
	}
	if($page->template->name == "category-main"){
		$listing_options["subcat"] = $product->parent(); 
		$product_list .= $files->render('components/subcategoryListingEntry', Array("product_shot_options"=>$listing_options));	
	} else {		
		$product_list .= $files->render('components/productListingEntry', Array("product_shot_options"=>$listing_options));	
	}
	$eager_count++;
}
echo "<main data-pw-id='main'>
		<h1 class='page-title'>$title</h1>
		<h2 class='status-message'>$status_message</h2>
			$search_again
		<section class='products'>
			<div class='card-viewer' data-action='closeLightbox'></div>
			$product_list
		</section>
	</main>";