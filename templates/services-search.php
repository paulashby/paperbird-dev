<?php namespace ProcessWire;
// Don't need csrf protection as search doesn't change anything
// https://stackoverflow.com/questions/6128940/when-its-necessary-to-protect-forms-with-token-csrf-attacks
bd(__LINE__);

if( ! $config->ajax) {
	// We shouldn't be here...
    $session->redirect($pages->get(27)->url);
    
} else {
	bd(__LINE__);
	$q = $input->get('q'); 

		if($q) {

			$q = explode(" ", $sanitizer->text($q));

			foreach($q as $key => $value){

				$reqs[$key] = $sanitizer->selectorValue($value);

			}

			$search_term_string = implode("|", $q);

			bd($search_term_string);

			$selector = "template=product, title|tags|artist*=" . $search_term_string;
			$matches = $pages->find($selector);
			$result_count = count($matches);

			if($result_count) {

				$matches->sort("title");
				$match_string = $result_count > 1 ? "$result_count matches" : "$result_count match";

				$out = "<h2>Search returned $match_string</h2>
						<ul class='search_results'>";

				foreach ($matches as $match) {
					
					$out .= "<li class='search_result__entry'><a href='" . $match->url . "'>" . $match->title . "</a></li>";
				}


				$out .= "</ul>";

				return json_encode(array("success"=>true, "data"=>$out));

			}
			return json_encode(array("success"=>true, "data"=>"<h2>Your search returned no results</h2>"));

		}
		return json_encode(array("success"=>false, "error"=>"Unexpected input"));
	

}
