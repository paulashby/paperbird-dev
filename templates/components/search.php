<?php namespace ProcessWire;

//TODO: Search results need to be scrollable with search form at top, not bottom as currently

$out = "";
$close = "";

if($value["container"]){
	$search_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Search', 'button_class'=>'menu__entrybutton menu__entrybutton--search', 'button_type'=>'search']);
	$out .= "<h2>{$search_button}</h2>
	<div class='search'>";
	$close = "</div>";
}
$submit_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--submit', 'button_type'=>'submit', 'action'=>'search']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'action'=>'cancel']);

	$out .= "<form class='form form--search' action='/' method='get'>
		<div class='form__inputs'>
			<input class='form__input' type='text' name='q' id='search_query' placeholder='Search'/>
			{$submit_button}
			{$cancel_button}
		</div>
	</form>
	<p class='form__error form__error--submission'>No Error</p>";
	$out .= $close;

return $out;