<?php namespace ProcessWire;

$products = $pages->get("template=artists")->children();

$cart = $this->modules->get("OrderCart");

$title = $page->title;

if( ! isset($status_message)) {
	$status_message = "";	
}
if( ! isset($search_again)) {
	$search_again = "";
}

$lazyImages = $modules->get("LazyResponsiveImages");
$max_eager = (int) $lazyImages->getMaxEager("subcat");
$eager_count = 0;
$product_list = "";

foreach ($products as $product) {

    if($eager_count < $max_eager) {

        $listing_options["lazy_load"] = false;

    } else {

        $listing_options["lazy_load"] = true;

    }
    $product_url = $product->url;	

    $selected_sample = $product->biography_card;

    if($selected_sample) {
        $product_shot = $selected_sample->product_shot->first();
        $dsc = $product_shot->description;
        $alt_str = $dsc ? $dsc : $product->title;
        $product_shot_options = array(
            // Listings images open the lightbox when clicked, cart images don't
            "context" => "catalogue",
            "product_data_attributes" => "",
            "product" => $selected_sample,
            "field_name" => "product_shot",
            "sizes"=>"(min-width: 1200px) 202px, (min-width: 815px) 16.85vw, (min-width: 550px) 22.8vw, 39vw",
            "class"=>"products__product-shot keyline",
            "image" => $product_shot,
            "alt_str" => $alt_str,
            "lazy_load" => true,
            "webp" => true,
            "loaded_callback" => " onload=\"$(this).addClass('loaded');\""
        );
        $product_list .= "<div class='products__product'>
        <a href='$product_url' class='subcat-link'>";
        $product_list .= $lazyImages->renderImage($product_shot_options);
        $product_list .= "<h2 class='products__title'>" . $product->title . "</h2>
        </a>
        </div><!-- End Products__product -->";
    }
    $eager_count++;

}
echo "<main data-pw-id='main'>
		<h1 class='page-title'>$title</h1>
		<h2 class='status-message'>$status_message</h2>
			$search_again
		<section class='products'>
			<div class='card-viewer' data-action='closeLightbox'></div>
			$product_list
		</section>
	</main>";