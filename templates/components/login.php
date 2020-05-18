<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant

$forgotten_pw_url = "#"; // Placeholder

$out = "<h2><a href='#' class='menu__entrybutton menu__entrybutton--login' data-buttontype='login'>Log in</a></h2>
		<div class='login'>
			<form class='form form--login' action='' method='post'>
				<div class='form__inputs'>
					<input type='email' class='form__input form__input--email' name='email' placeholder='Email address'>
					<input type='password' class='form__input form__input--password' name='pass' placeholder='Password'>
					<input type='submit' class='form__button form__button--submit' value='Submit'>
					<input type='button' class='form__button form__button--cancel' value='Cancel'>
				</div>								
			</form>
			<p class='form__forgotten-password'><a class='form__forgotten-password-link' href='$forgotten_pw_url'>Forgot password?</a></p>
			
		</div>";

return $out;
