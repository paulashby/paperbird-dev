<?php 

$components = $value['components'];
$animated = isset($value['animate_menu_button']) && $value['animate_menu_button'] !== false;
$open_menu_button = '';
$close_menu_button = '';

if($animated) {
	$open_menu_button = $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--toggle']);	

	$out = "<div class='menu menu--anim-bttn'>" . $open_menu_button . 
	"<ul class='menu__entries'>";
} else {
	$open_menu_button = $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--open']);
	$close_menu_button = "<li>" . $files->render('components/buttons/menuButton', ['button_class'=>'menu__button menu__button--close']) . "</li>";


	$out = "<div class='menu menu--static-bttn'>" . $open_menu_button . 
	"<ul class='menu__entries'>" . $close_menu_button;
}
	
	foreach($components as $key => $value) {

		/*
		 *	This is a mixed associative and indexed array. 
		 *	$key on indexed entries will be an integer, $value will be field type
		 *	$key on associative entries will be field type, $value will be field options
		*/ 

		if(is_int($key)) {
			$out .= "<li class='menu__entry'>" . $files->render('components/' . $value) . "</li>";	
		} else {
			$out .= "<li class='menu__entry'>" . $page->renderValue($value, $key) . "</li>";	
		}
	}

$out .= "	</ul>
</div>";

echo $out;