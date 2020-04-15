<?php 

$out = "<div class='menu'>
	<div class='menu__toggle'>
	  <div class='menu__toggle-bar menu__toggle-bar--1'></div>
	  <div class='menu__toggle-bar menu__toggle-bar--2'></div>
	  <div class='menu__toggle-bar menu__toggle-bar--3'></div>
	</div> 
	<ul class='menu__entries'>";
	
$options = $value;

foreach($options as $key => $value) {	
	
	$out .= "<li>" . $page->renderValue($value, $key) . "</li>";

}

$out .= "	</ul>
</div>";

echo $out;