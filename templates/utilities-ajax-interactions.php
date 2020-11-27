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

			$customCartImages = function($product, $img_count) {

				$lazyImages = $this->modules->get("LazyResponsiveImages");
				$max_eager = (int) $lazyImages->getMaxEager("cart");
				$lazy_load = $img_count > $max_eager;

				//TODO: Check sizes of these cart images- they're sizes for listings
			    $listing_options = [
			    	"sub_cat"=>true, // Just so it's defined
			        "lazyImages"=>$lazyImages,
			        "product"=>$product,
			        "field_name"=>"product_shot",
			        "context"=>"listing", // Just so it's defined
			        "desktop_hdpi"=>"200",
			        "sizes"=>"(max-width: 1000px) 150px, 100px",
			        "class"=>"products__product-shot",
			        "lazy_load"=>$lazy_load
			    ];
				return $this->files->render('components/productListingEntry', $listing_options);
			};
			$cart = $this->modules->get("OrderCart");
			$cart_content = $cart->populateCart($customCartImages);
			return json_encode(array("success"=>true, "data"=>$cart_content));

		case "search":
			$q = $input->get('q'); 
			$out = $files->render("components/search", array("value"=>array("container" => false)));
			$no_results = "<h3>Your search returned no results</h3>";

			if($q) {

				$q = explode(" ", $sanitizer->text($q));

				foreach($q as $key => $value){
					$reqs[$key] = $sanitizer->selectorValue($value);
				}

				$search_term_string = implode("|", $q);
				$selector = "template=product, title|tags|artist~=" . $search_term_string . ", limit=30";
				$matches = $pages->find($selector);
				$result_count = count($matches);

				if($result_count) {

					$cart = $this->modules->get("OrderCart");
					$matches->sort("title");
					$match_string = $result_count > 1 ? "$result_count matches" : "$result_count match";
					$out .= "<h3>Search returned $match_string</h3>";

					foreach ($matches as $match) {
						//TODO: we want everything a lightbox entry gets - then these are all the customer needs to place an order!
						$out .= $cart->renderItem($match);
					}

				} else {
					$out .= $no_results;
				}
			} else {
				$out .= $no_results;
			}
			return json_encode(array("success"=>true, "data"=>$out));
		
		default:
			return json_encode(array("success"=>false, "error"=>"Unknown AJAX action: '$action'"));
	}
}
