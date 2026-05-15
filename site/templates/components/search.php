<?php namespace ProcessWire;

$urls = include $config->paths->templates . "utilities-urls.php";
$search_url = $urls["search"];

$out = "";
$close = "";

if($value["container"]){
	$search_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Search', 'button_class'=>'menu__entrybutton menu__entrybutton--search', 'button_type'=>'search']);
	$out .= "<div>{$search_button}</div>
	<div class='search'>";
	$close = "</div>";
}
$submit_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--submit', 'button_type'=>'submit', 'action'=>'search']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'action'=>'cancel', 'label'=>'close']);

	$out .= "<form class='form form--search' action='$search_url' method='get'>
		<div class='form__inputs'>
			<input class='form__input' type='text' name='q' id='search_query' autocomplete='off' placeholder='Search'>
			{$submit_button}
			{$cancel_button}
		</div>
	</form>
	<p class='form__error form__error--submission'>No Error</p>";
	$out .= $close;

return $out;