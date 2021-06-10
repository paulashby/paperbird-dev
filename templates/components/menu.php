<?php namespace ProcessWire;

$animated = isset($animate_menu_button) && $animate_menu_button !== false;
$open_menu_button = '';
$close_menu_button = '';

if($animated) {
	$open_menu_button = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--toggle', 'action'=>'toggleMenuDisplay']);	

	$out = "<div class='menu menu--anim-bttn'>" . $open_menu_button . 
	"<ul class='menu__entries'>";
} else {
	$open_menu_button = $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--open', 'action'=>'toggleMenuDisplay']);
	$close_menu_button = "<li>" . $files->render('components/buttons/toggleButton', ['button_class'=>'toggle__button toggle__button--close', 'action'=>'toggleMenuDisplay']) . "</li>";


	$out = "<div class='menu menu--static-bttn'>" . $open_menu_button . 
	"<ul class='menu__entries'>" . $close_menu_button;
}

if(isset($components)){
	
	foreach($components as $key => $value) {

		/*
		 *	This is a mixed associative and indexed array. 
		 *	$key on indexed entries will be an integer, $value will be field type
		 *	$key on associative entries will be field type, $value will be field options
		*/ 

		if(is_int($key)) {
			$class_sffx = "menu__entry--$value";
			$out .= "<li class='menu__entry $class_sffx'>" . $files->render('components/' . $value) . "</li>";
		} else {
			$class_sffx = "menu__entry--$key";
			$out .= "<li class='menu__entry $class_sffx'>" . $files->render('components/' . $key, array("value"=>$value)) . "</li>";
		}
	}
}

$out .= "	</ul>
</div>";

echo $out;