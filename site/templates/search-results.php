<?php namespace ProcessWire;

$products = new PageArray();
$status_message = "";

$q = $input->get('q'); 
	$search_form = $files->render("components/search", array("value"=>array("container" => false)));
	$search_again = "<div class='search--again'>$search_form</div>";
	
	$query_out = $sanitizer->entities($q);
	$no_results = "No results were found for $query_out";

	if($q) {

		// Make hyphenated terms separate words
		$q = str_replace("-", " ", $q);
		$q = explode(" ", $sanitizer->selectorValue($q));
		$input->whitelist($q); 
		$selector = "";

		foreach($q as $key => $part) {

			$part = strtolower($part);
			$selector_operator = strlen($part) > 3 ? "~=" : "%=";

			// use MySQL LIKE for words under 4 characters in length, use MySQL fulltext index for words 4 characters and higher
			$selector .= ", title|tags.title|artist.title|sku$selector_operator" . $sanitizer->selectorValue($part);
		}
		
        $selector = "template=product, $selector";
		$matches = $pages->find($selector);
		$result_count = count($matches);

		if($result_count) {

			$matches->sort("title");
			$match_string = $result_count > 1 ? "$result_count matches" : "$result_count match";
			$status_message = "$match_string for $query_out";
			
			foreach ($matches as $match) {
				$products->add($match);
			}

		} else {
			$status_message .= $no_results;
		}
	} else {
		$status_message .= $no_results;
	}

include "includes/_listingsPage.php";