<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");
$settings = $this->modules->get("ProcessOrderPages");
$sku_field = $settings['f_sku'];

$title = $page->title;

$sub_cats = $page->children();
$sub_cats_out = "";

foreach ($sub_cats as $sub_cat) {

	// Could make a settings page to store stuff like which images should be used for each category - make it a page select field and select the product whose image should be used.

	$sc_link = $sub_cat->path;
	$sc_title = $sub_cat->title;
	$sub_cats_out .= "<li><a href='$sc_link'>$sc_title</a></li>";
}

echo "<main data-pw-id='main'>
<h1>Hello, this is the $title page</h1>
<ul>
	$sub_cats_out
</ul>
</main>";

// From subcat - note how each entry is contained in an anchor
/*
$cart = $this->modules->get("OrderCart");
$category = $page->parent->title;
$title = $page->title;
$products = $page->children();
$products_out = "";
$size = $cart->getProductShotSize(true);

foreach ($products as $product) {
	$product_shot = $product->product_shot->first();
	$product_shot_url = $product_shot->size($size, $size)->url;
	$dsc = $product_shot->description;
	$alt_text = $dsc ? $dsc : $product->title;
	$sku = $product->sku;
	$product_title = $product->title;
	$products_out .= "<a class='product'><img src='$product_shot_url' alt='$alt_text'><p>$sku</p><h2>$product_title</h2></a>";
}
*/