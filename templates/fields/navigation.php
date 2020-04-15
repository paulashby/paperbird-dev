<?php

$tree_menu = $modules->get("MarkupSimpleNavigation");
$options = $value;

function myItemString(HookEvent $event){
    $child = $event->arguments('page'); // current rendered child page
    // any logic with $child possible here

    $is_level_1 = $child->parent->template->name == "home";

    if($is_level_1){
        // set the return value of this hook to a custom string
        $event->return = getLevel1($child);
    }
}

// Hook for custom item string
// http://modules.processwire.com/modules/markup-simple-navigation/
$tree_menu->addHookAfter('getItemString', null, 'myItemString');

return "<nav>" . $tree_menu->render($options) . "</nav>";

function getLevel1 ($child) {

	$cat = $child->title;
	$cat_lc = str_replace(' ', '', strtolower($cat));

	if($child->hasChildren()) {
		return "<a href='#' class='nav__top-cat nav__top-cat--$cat_lc' data-cat='$cat_lc'>$cat</span></a>";
		// ▾
	}

	return "<a href='#' class='nav__top-link  nav__top-link--$cat_lc' data-cat='$cat_lc'>$cat</a>";

}