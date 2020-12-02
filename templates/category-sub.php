<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

$category = $page->parent->title;
$title = $page->title;
$products = $page->children();
$product_list = "";

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