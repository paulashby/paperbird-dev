<?php namespace ProcessWire;

$subcats = $page->children();
$subcat_image_pages = new PageArray();

foreach ($subcats as $image_src_pg) {
	if($image_src_pg->category_image_page) {
		$subcat_image_pages->add($image_src_pg->category_image_page); 
	}
}

$products = $subcat_image_pages;

include "includes/_listingsPage.php";