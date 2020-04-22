<?php 

$components = $value['components'];
$animated = isset($value['animated']) && $value['animated'] !== false;

$open_menu_button = '';
$close_menu_button = '';

if($animated) {
	$open_menu_button = $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--toggle']);	
} else {
	$open_menu_button = $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--open']);
	$close_menu_button = "<li>" . $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--close']) . "</li>";
}

$out = "<div class='menu'>" . $open_menu_button . 
	"<ul class='menu__entries'>" . $close_menu_button;
	
foreach($components as $field_type => $value) {	
	
	$value = $field_type === "navigation" ? getNavigationOptions(true) : $value;
	$out .= "<li>" . $page->renderValue($value, $field_type) . "</li>";

}

$out .= "	</ul>
</div>";

echo $out;

function getNavigationOptions ($include_button = false) {

    // template string for the items. || will contain entries, %s will replaced with class="..." string

    // 'list_field_class' => '{title}', // string (default '') add custom classes to each list_tpl using tags like {field} i.e. {template} p_{id}

	return array(
		"tree_options" =>array (
	        "parent_class" => "parent",
	        "levels" => true,
	        "levels_prefix" => "nav__level-",
	        "max_levels" => 2,
	        "outer_tpl" => "<ul class='nav__top-level'>||</ul>",
	        "inner_tpl" => "<ul class='nav__dropdown'>||</ul>",
	    ), 
	    "include_button" => $include_button
    );
}