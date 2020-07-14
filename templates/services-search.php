<?php namespace ProcessWire;
// Don't need csrf protection as search doesn't change anything
// https://stackoverflow.com/questions/6128940/when-its-necessary-to-protect-forms-with-token-csrf-attacks

$out = "<main data-pw-id='main'>";

$q = $input->get('q'); 
$no_results = "<h3>Your search returned no results</h3>";

if($q) {

	$q = explode(" ", $sanitizer->text($q));

	foreach($q as $key => $value){
		$reqs[$key] = $sanitizer->selectorValue($value);
	}

	$search_term_string = implode("|", $q);
	$selector = "template=product, title|tags|artist*=" . $search_term_string;
	$matches = $pages->find($selector);
	$result_count = count($matches);

	if($result_count) {

		$cart = $this->modules->get("OrderCart");
		$matches->sort("title");
		$match_string = $result_count > 1 ? "$result_count matches" : "$result_count match";
		$out .= "<h3>Search returned $match_string</h3>";

		foreach ($matches as $match) {
			$out .= $cart->renderItem($match);
		}

	} else {
		$out .= $no_results;
	}
} else {
	$out .= $no_results;
}
echo $out . "</main>";