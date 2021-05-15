<?php namespace ProcessWire;

$title = $page->title;
$artists = wire("pages")->find("template=" . $sanitizer->selectorValue("artist"));
$artists_out  = "<div class='artists'>";

$lazyImages = $modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("subcat");
$eager_count = 0;

foreach ($artists as $entry => $artist) {
	bd($artist);
 	$artist_name = $artist->title;

 	$product = $artist->biography_card;
 	$img = "";
 	if($product) {
 		// echo $artist->biography_card("<a href='{url}'>{title}</a>");
		// $artists_out .= <img src="		
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
			"sizes"=>"(max-width: 1000px) 300px, 200px",
			// if viewport width = 1000 or less use 300px, else use 300px - seems backwards?
		];
		if($eager_count < $max_eager) {

			$product_shot_options["lazy_load"] = false;
		
		} else {

			$product_shot_options["lazy_load"] = true;
			
		}

		$img = $lazyImages->renderImage($product_shot_options);

		$eager_count++;
	}
 	$artists_out .= "<h2 class='artist__name'>$artist_name</h2>";
 	$artists_out .= $img;
 	$artists_out .= "<p class='artist__biography'>" . $sanitizer->entities($artist->biography) . "</p>";
 }
 $artists_out  .= "</div><!-- END artists -->";

echo "<main data-pw-id='main' class='artists'>
	<h1 class='page-title'>$title</h1>
	$artists_out
</main>";
?>