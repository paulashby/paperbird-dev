<?php namespace ProcessWire;

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
	    "sliding" => false
    );
}

$tree_menu = $modules->get("MarkupSimpleNavigation");
$sliding = $value["sliding"];
$tree_options = $value["tree_options"];

// Hook for custom item string
// http://modules.processwire.com/modules/markup-simple-navigation/
// Used anonymous function so I could pass in $sliding var
// https://processwire.com/talk/topic/14879-solved-can-i-pass-a-variable-to-a-hook-function/
$tree_menu->addHookAfter('getItemString', function($event) use($sliding) {
	
     $child = $event->arguments('page'); // current rendered child page
    // any logic with $child possible here
   
    $is_level_1 = $child->parent->template->name == "home";
    if($is_level_1){
    	
        // set the return value of this hook to a custom string
        $event->return = getLevel1($child, $sliding);
    } else if($child->parent->parent->template->name == "home"){
    	$event->return = getLevel2($child);
    }
});
$nav_class = $sliding ? "nav--sliding" : "nav--simple ";

return "<nav class='nav $nav_class'>" . $tree_menu->render($tree_options) . "</nav>";

function getLevel1 ($child, $sliding) {
	$cat = $child->title;
	$cat_lc = str_replace(' ', '', strtolower($cat));
	$link = $child->url();
	$button_str = $sliding ? " nav__top-cat--buttoned" : "";

	if($child->hasChildren()) {
		return "<a href='$link' class='nav__top-cat nav__top-cat--$cat_lc $button_str' data-cat='$cat_lc' data-action='toggleDropdown'>$cat</span></a>";
	}

	return "<a href='$link' class='nav__top-link  nav__top-link--$cat_lc' data-cat='$cat_lc'>$cat</a>";

}
function getLevel2 ($child) {
	$link = $child->url();
	$cat = $child->title;

	return "<a href='$link' class='nav__level-2-link'>$cat</a>";
}