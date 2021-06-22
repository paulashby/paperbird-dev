<?php namespace ProcessWire;

$artist_name = $page->title;
$products  = $pages->find("template=product, artist=$artist_name");

include "includes/_listingsPage.php";