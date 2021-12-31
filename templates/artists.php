<?php namespace ProcessWire;

$title = $page->title;
$artists = wire("pages")->find("template=" . $sanitizer->selectorValue("artist"));
$artists_out  = "<div class='artist__list'>";

$lazyImages = $modules->get("LazyResponsiveImages");
// $max_eager = (int) $lazyImages->getMaxEager("subcat");
// Disabling lazy loading for now as Chrome is making repeated ajax calls then cancelling the requests, causing the loads to stall
$max_eager = 1000;
$eager_count = 0;	

foreach ($artists as $entry => $artist) {

	$product = $artist->biography_card;
 	$img = "";
 	if($product) {
 		$product_shot = $product->product_shot->first();
		$dsc = $product_shot->description;
		$alt_str = $dsc ? $dsc : $product->title;
		$product_shot_options = [
			"alt_str"=>$alt_str,
			"class"=>"artist__image",
			"context"=>"listing",
			"field_name"=>"product_shot",
			"image"=>$product_shot,
			"product_data_attributes"=>"",
			"sizes"=>"(min-width: 650px) 37vw, (min-width: 1200px) 450px, 75vww",
			"webp"=>true
		];
		if($eager_count < $max_eager) {

			$product_shot_options["lazy_load"] = false;
		
		} else {

			$product_shot_options["lazy_load"] = true;
			
		}

		$img = $lazyImages->renderImage($product_shot_options);

		$eager_count++;
	}
 	
 	$artist_name = $artist->title;
 	$artist_url = $artist->url;
	$biog = $artist->page_content;
 	$artists_out .= "<a href='$artist_url'><div class='artist-entry'>$img<div class='artist-entry__text'><h2>$artist_name</h2>$biog</div></div></a><!-- END artist-entry -->";
 }
 $artists_out  .= "</div><!-- END artists -->";

echo "<main data-pw-id='main' class='artists generic-page'>
	<h1 class='page-title'>$title</h1>
	$artists_out
</main>";
?>