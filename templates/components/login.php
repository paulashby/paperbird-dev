<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant

$forgotten_pw_url = "#"; // Placeholder

$out = "<h2><a href='#' class='menu__entrybutton menu__entrybutton--login' data-buttontype='login'>Log in</a></h2>
		<div class='login'>
			<form class='login__form' action='' method='post'>
				<div class='login__inputs'>
					<input type='email' class='login__input' name='email' placeholder='Email address'>
					<input type='password' class='login__input' name='pass' placeholder='Password'>
					<input type='submit' class='form__button form__button--submit' value='Submit'>
					<input type='button' class='form__button form__button--cancel' value='Cancel'>
				</div>								
			</form>
			<p class='login__forgotten-password'><a class='login__forgotten-password-link' href='$forgotten_pw_url'>Forgot password?</a></p>
			<p class='login__errors'></p>
		</div>";

return $out;
