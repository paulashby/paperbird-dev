<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant

$forgotten_pw_url = "#"; // Placeholder

$out = "<h2><a href='#' class='menu__entrybutton menu__entrybutton--login' data-buttontype='login'>Log in</a></h2>
		<div class='login'>
			<form class='login__form' action='' method='post'>
				<ul class='login__inputs'>
					<li><input type='email' class='login__input' name='email' placeholder='Email address'></li>
					<li><input type='password' class='login__input' name='pass' placeholder='Password'></li>
					<li><input type='submit' class='login__submit' value='Submit'></li>
				</ul>								
			</form>
			<p class='login__errors'></p>
			<p class='login__forgotten-password'><a href='$forgotten_pw_url'>Forgot your password?</a></p>
		</div>";

return $out;
