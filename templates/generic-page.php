<?php namespace ProcessWire;

$page_class = $page->name;
$title = $page->title;
$content = $page->page_content;

if($page_class == "whats-on"){
	
	$content = "";
	$entries = $page->children();

	foreach ($entries as $entry) {
		$entry_image = "";
		if(count($entry->image)){
			$entry_image_url = $entry->image->first()->url;
			$entry_image = "<img class='event-entry__image' src='$entry_image_url' alt='$entry->title'>";
		}
		$content .= "<div class='event-entry'>$entry_image<h2>$entry->title</h2>$entry->page_content</div><!-- END event-entry -->";
	}
}
echo "<main data-pw-id='main' class='generic-page generic-page--$page_class'>
	<h1 class='page-title'>$title</h1>
	<div class='gp__content gp__content--show'>$content</div>
</main>";



/*

re-arrange posts for two cols:
// Array of posts
$arr = array("a", "b", "c", "d", "e");
$sorted = array();

foreach ($arr as $i => $item){
  if($i % 2){
      $sorted[] = $item;
  } else {
      array_splice( $sorted, $i- $i * 0.5, 0, $item );
  }
 }
d($sorted);

0
1
---
2
3


Return posts to original order
$length = count($sorted);
$col_length = ceil($length/2);
$desorted = array_fill(0, $length, "error");
foreach ($sorted as $i => $item){
    if($i < $col_length) {
        $desorted[2 * $i] = $item;
    } else {
        $l = $length - (1 - $length%2); // length - 1 if even
        $desorted[$i + ($i - $l)] = $item;
    }
}

*/
?>
