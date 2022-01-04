<?php namespace ProcessWire;

$products = $page->children();
$products->add($page->duplicates);

include "includes/_listingsPage.php";
