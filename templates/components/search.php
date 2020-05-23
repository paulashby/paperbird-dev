<?php
// This form is from DAM system - Sites/r.io/templates/components/navigation.php
$search_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Search', 'button_class'=>'menu__entrybutton menu__entrybutton--search', 'button_type'=>'search']);
$submit_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--submit', 'button_type'=>'submit', 'action'=>'submit']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'action'=>'cancel']);

$out = "<h2>{$search_button}</h2>
<div class='search'>
	<form class='form form--search' action='/' method='get'>
		<div class='form__inputs'>
			<input class='form__input' type='text' name='q' id='search_query' placeholder='Search'/>
			{$submit_button}
			{$cancel_button}
		</div>
	</form>
</div>";

return $out;