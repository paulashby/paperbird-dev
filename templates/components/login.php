<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant

$forgotten_pw_url = "#"; // Placeholder

$out = "<div class='login'>
			<h2 class='login__title'>Log in</h2>
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