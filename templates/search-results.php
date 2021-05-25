<?php namespace ProcessWire;

$products = new PageArray();
$status_message = "";

$q = $input->get('q'); 
	$out = $files->render("components/search", array("value"=>array("container" => false)));
	$query_out = $sanitizer->entities($q);
	$no_results = "No results were found for $query_out";

	if($q) {

		$q = explode(" ", $sanitizer->text($q));

		foreach($q as $key => $value){
			$input->whitelist('q', $q); 
			$reqs[$key] = $sanitizer->selectorValue($value);
		}

		$search_term_string = implode("|", $q);
		$selector = "template=product, title|tags|artist~=" . $search_term_string . ", limit=30";
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