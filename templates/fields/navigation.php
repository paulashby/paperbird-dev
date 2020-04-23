<?php

// Use defaults if no options provided
if( ! is_array($value)) {
	$value = array(
		"tree_options" =>array (
	        "parent_class" => "parent",
	        "levels" => true,
	        "levels_prefix" => "nav__level-",
	        "max_levels" => 2,
	        "outer_tpl" => "<ul class='nav__top-level'>||</ul>",
	        "inner_tpl" => "<ul class='nav__dropdown'>||</ul>",
	    ), 
	    "include_button" => false
    );
}

$tree_menu = $modules->get("MarkupSimpleNavigation");
$include_button = $value["include_button"];
$tree_options = $value["tree_options"];

// Hook for custom item string
// http://modules.processwire.com/modules/markup-simple-navigation/
// Used anonymous function so I could pass in $include_button var
// https://processwire.com/talk/topic/14879-solved-can-i-pass-a-variable-to-a-hook-function/
$tree_menu->addHookAfter('getItemString', function($event) use($include_button) {
	
     $child = $event->arguments('page'); // current rendered child page
    // any logic with $child possible here
   
    $is_level_1 = $child->parent->template->name == "home";

    if($is_level_1){
        // set the return value of this hook to a custom string
        $event->return = getLevel1($child, $include_button);
    }
});

return "<nav class='nav'>" . $tree_menu->render($tree_options) . "</nav>";

function getLevel1 ($child, $include_button) {
	$cat = $child->title;
	$cat_lc = str_replace(' ', '', strtolower($cat));
	$link = $child->url();
	$button_str = $include_button ? " nav__top-cat--buttoned" : "";

	if($child->hasChildren()) {
		return "<a href='$link' class='nav__top-cat nav__top-cat--$cat_lc $button_str' data-cat='$cat_lc'>$cat</span></a>";
	}

	return "<a href='#' class='nav__top-link  nav__top-link--$cat_lc' data-cat='$cat_lc'>$cat</a>";

}