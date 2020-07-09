<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");

if( ! $config->ajax) {

	$products = $page->children();
	$products_out = "";

	$title = $page->title;

	foreach ($products as $product) {
		$products_out .= $cart->renderItem($product);
	}

	echo "<main data-pw-id='main'>
	<h1>Hello, this is the $title page</h1>
	$products_out
	</main>";
}