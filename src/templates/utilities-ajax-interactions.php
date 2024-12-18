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
		$cart_data = $cart->populateCart("components/customCartImages");
		return json_encode(array("success"=>true, "data"=>$cart_data));

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
				<div class='search__results'>";

				foreach ($matches as $match) {
					$out .= $cart->renderItem($match, "search");
				}
				$out .= "</div><!-- End search__results -->";

			} else {
				$out .= $no_results;
			}
		} else {
			$out .= $no_results;
		}
		return json_encode(array("success"=>true, "data"=>$out));

		case "loadPost":

			$post_id = $input->get("id", "int");
			$post_page = wire("pages")->get($post_id);
			$num_posts = $input->get("num_posts", "int");
			$out = array(
				"markup"=>"");

			for ($i=0; $i < $num_posts; $i++) {

				$out["markup"] .= getPost($post_page);
				$out["next_newest_id"] = getNextNewestID($post_page);
				$post_page = $pages->get($out["next_newest_id"]);

				if( ! $out["next_newest_id"]) {
					break;
				}
			}
			return json_encode(array("success"=>true, "data"=>$out));

		case "loadArtistItems":
			$artist_name = $input->get("artist", "text");
            $artist_page = wire("pages")->get("/the-artists/$artist_name/");
            $artist_page_has_children = $artist_page && $artist_page->hasChildren();
            $selector = $artist_page_has_children ? "parent=/the-artists/$artist_name/" : "template=product, artist={$artist_page->id}";

			$num_items = (int) $input->get("num_items", "int");
			$start_after = $input->get("start_after", "int");

			$selector_options = array("limit" => $input->get("num_items", "int"));
			if($start_after){
				$selector_options["startAfterID"] = $start_after;
			}

			$items = wire("pages")->find($selector, $options = $selector_options);

			$out = array(
				"markup"=>"");

			$item_options = array(
				"lazyImages"=>$modules->get("LazyResponsiveImages"),
				"items_added" => 0
			);
			$item_options["max_eager"] = (int) $item_options["lazyImages"]->getMaxEager("artist");

			foreach ($items as $item) {

				if($item_options["items_added"] < $num_items){
                    $item_options["item"] = $item;
                    $out["markup"] .= getArtistItem($item_options);
                    $out["last_loaded"] = $item->id;

                    $item_options["items_added"]++;
                    $current_item = $item->id;
                }
				$out["next"] = $item->next();
			}
			return json_encode(array("success"=>true, "data"=>$out));

		default:
		return json_encode(array("success"=>false, "error"=>"Unknown AJAX action: '$action'"));
}
function getNextNewestID ($post_page) {

	$next_newest = $post_page->prev();
	return $next_newest ? $next_newest->id : false;
}
function getArtistItem($options) {

		$listing_options = [
		"lazyImages"=>$options["lazyImages"],
		"product"=>$options["item"],
		"field_name"=>"product_shot",
		"context"=>"listing",
		// See Notes/SrcSet Planning.txt
		"sizes"=>"(min-width: 1200px) 202px, (min-width: 815px) 16.85vw, (min-width: 550px) 22.8vw, 39vw",
		"class"=>"products__product-shot"
	];

	if($options["items_added"] < $options["max_eager"]) {

		$listing_options["lazy_load"] = false;

	} else {

		$listing_options["lazy_load"] = true;

	}

	return wire("files")->render('components/productListingEntry', Array("product_shot_options"=>$listing_options));
}
function getPost ($post_page) {

	if($post_page->id) {

		$out = array();
		$title = $post_page->title;
		$story_details = $post_page->story_details;
		if($story_details){
			$story_details = "<div class='story__details'>$story_details</div>";
		}
		$class_list = "blog-post";
		$post_content = $post_page->page_content;
		$post_image = "";

		$product = $post_page->biography_card;
	 	if($product) {
	 		// Post uses image from existing product
	 		// $post_image = $product->product_shot->first();
	 		$post_image = getPostImage($product->product_shot->first(), $title);
	 		$class_list .= " product_shot";
	 	} else {
	 		// Post has its own image
	 		$img = $post_page->image;
	 		if($img->count()){
	 			$post_image = getPostImage($img->first(), $title);
	 		}
	 	}

		return "<div class='$class_list'>$post_image<div class='blog-post__text'><h2>$title</h2>{$post_content}{$story_details}</div></div><!-- END blog-post -->";

	}

	return "<div class='blog-post'><div class='blog-entry__text'><h2>item not found</h2><p>It seems like the requested item is no longer available.</p></div></div><!-- END blog-post -->";

}
function getPostImage ($image, $title) {

	$image_description = $image->description;
	$alt_str = strlen($image_description) ? $image_description : $title;

	$image_options = array(
		"alt_str"=>$alt_str,
		"class"=>"blog-image",
		"context"=>"blog",
		"field_name"=>"image",
		"image"=>$image,
		"product_data_attributes"=>"",
		"sizes"=>"(min-width: 615px) 48vw, (min-width: 1070px) 574px, 75vww",
		"lazy_load"=>false,
		"webp"=>true
	);

	$lazyImages = wire("modules")->get("LazyResponsiveImages");
	return $lazyImages->renderImage($image_options);
}

