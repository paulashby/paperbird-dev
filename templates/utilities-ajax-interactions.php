<?php namespace ProcessWire;

if( ! $config->ajax) {
	// We shouldn't be here...
	throw new Wire404Exception();
}

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
		$cart = $this->modules->get("OrderCart");
		$cart_content = $cart->populateCart("components/customCartImages");
		return json_encode(array("success"=>true, "data"=>$cart_content));

	case "search":
		$q = $input->get('q'); 
		$out = $files->render("components/search", array("value"=>array("container" => false)));
		$no_results = "<h3 class='search__title search__title--unfound'>Your search returned no results</h3>";

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
				$out .= "<h3 class='search__title'>Search returned $match_string</h3>
				<div class='search_message'><p class='search_message-text'><span class='search_message-content'>Added to cart</span></p></div>
				<div class='search__results'>";

				foreach ($matches as $match) {
					$out .= $cart->renderItem($match);
				}
				$out .= "</div><!-- End search__results -->";

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
