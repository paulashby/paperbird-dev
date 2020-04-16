<?php 

$out = "<div class='menu'>
	<div class='menu__toggle'>
	  <div class='menu__toggle-bar menu__toggle-bar--1'></div>
	  <div class='menu__toggle-bar menu__toggle-bar--2'></div>
	  <div class='menu__toggle-bar menu__toggle-bar--3'></div>
	</div> 
	<ul class='menu__entries'>";
	
$options = $value;
foreach($options as $field_type => $value) {	
	TD::barDump($value, $field_type);
	$out .= "<li>" . $page->renderValue($value, $field_type) . "</li>";

}

$out .= "	</ul>
</div>";

echo $out;