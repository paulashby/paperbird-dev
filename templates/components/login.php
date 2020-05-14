<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant

$forgotten_pw_url = "#"; // Placeholder

$out = "<h2><a href='#' class='menu__entrybutton menu__entrybutton--login' data-buttontype='login'>Log in</a></h2>
		<div class='login'>
			<form class='login__form' action='' method='post'>
				<ul class='login__inputs'>
					<li class='login__input-item login__input-item--email'><input type='email' class='login__input' name='email' placeholder='Email address'></li>
					<li class='login__input-item login__input-item--password'><input type='password' class='login__input' name='pass' placeholder='Password'></li>
					<li class='login__input-item login__input-item--submit'><input type='submit' class='form__button form__button--submit' value='Submit'></li>
					<li class='login__input-item login__input-item--cancel'><input type='button' class='form__button form__button--cancel' value='Cancel'></li>
				</ul>								
			</form>
			<p class='login__forgotten-password'><a class='login__forgotten-password-link' href='$forgotten_pw_url'>Forgot password?</a></p>
			<p class='login__errors'></p>
		</div>";

return $out;
