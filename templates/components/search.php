<?php
// This form is from DAM system - Sites/r.io/templates/components/navigation.php

$out = "<h2><a href='#' class='menu__entrybutton menu__entrybutton--search' data-buttontype='search'>Search</a></h2>
<div class='search'>
	<form class='form form--search' action='/' method='get'>
		<div class='form__inputs'>
			<input class='form__input' type='text' name='q' id='search_query' placeholder='Search'/>
			<input type='submit' class='form__button form__button--submit' value='Submit'>
			<input type='button' class='form__button form__button--cancel' value='Cancel'>
		</div>
	</form>
</div>";

return $out;