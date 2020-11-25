<?php namespace ProcessWire;

if( $config->ajax) {

	$action = $input->get("action", "text");

	switch ($action) {
		case "populateLightbox":
			$sku = $input->get("sku", "text");

			if($sku) {
				$cart = $this->modules->get("OrderCart");
				// Get lightbox markup
				$lightbox = $files->render('components/lightbox', ['sku'=>$sku, 'cart'=>$cart, 'action'=>'toggleMenuDisplay']);	

				return json_encode(array("success"=>true, "data"=>$lightbox));

			} 
			return json_encode(array("success"=>false, "error"=>"Users must be logged in to use the cart"));

		case "populateCart":
			$customCartImages = function($product) {
				//TODO: Check sizes of these cart images- they're sizes for listings
			    $listing_options = [
			        "sub_cat"=>true, // Just so it's defined
			        "lazyImages"=>$this->modules->get("LazyResponsiveImages"),
			        "product"=>$product,
			        "field_name"=>"product_shot",
			        "context"=>"listing", // Just so it's defined
			        "desktop_hdpi"=>"200",
			        "sizes"=>"(max-width: 1000px) 150px, 100px",
			        "class"=>"products__product-shot",
			        "lazy_load"=>false // All lazy?
			    ];
				return $this->files->render('components/productListingEntry', $listing_options);
			};
			$cart = $this->modules->get("OrderCart");
			$cart_content = $cart->populateCart($customCartImages);
			return json_encode(array("success"=>true, "data"=>$cart_content));
		
		default:
			return json_encode(array("success"=>false, "error"=>"Unknown AJAX action: '$action'"));
	}
}
