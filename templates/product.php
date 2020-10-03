<?php namespace ProcessWire;

$out = "<div>";

$dsc = $page->product_shot->description;
$alt_text = $dsc ? $dsc : $page->title;
$sku = $page->sku;

$out .= "<main data-pw-id='main'>
<img src='" . $page->product_shot->first()->size(200,0)->url . "' alt='" . $alt_text . "'>
	<p>$sku</p>
	</div>
	</main>";
	
echo $out;