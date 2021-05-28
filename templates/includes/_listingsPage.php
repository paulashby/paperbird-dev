<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

$title = $page->title;

if( ! isset($status_message)) {
	$status_message = "";	
}

$product_list = "";

$lazyImages = $modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("subcat");
$eager_count = 0;

foreach ($products as $product) {

	$listing_options = [
		"lazyImages"=>$lazyImages,
		"product"=>$product,
		"field_name"=>"product_shot",
		"context"=>"listing",
		"sizes"=>"(max-width: 1000px) 150px, 100px",
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
		<section class='products'>
			<div class='card-viewer' data-action='closeLightbox'></div>
			$product_list
		</section>
	</main>";