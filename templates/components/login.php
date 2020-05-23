<?php
// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/
// This form is from DAM system - Sites/r.io/templates/interface-body.inc.php
//  The classes have been adjusted to be more BEM compliant
$form_processor = $pages->get(1017)->url;
$forgotten_pw_url = "#"; // Placeholder
$login_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Log in', 'button_class'=>'menu__entrybutton menu__entrybutton--login', 'button_type'=>'login']);
$submit_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--submit', 'button_type'=>'submit', 'action'=>'submit']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'action'=>'cancel']);

$out = "<h2>{$login_button}</h2>
		<div class='login'>
			<form class='form form--login' action='{$form_processor}' method='post'>
				<div class='form__inputs'>
					<input type='email' class='form__input form__input--validate form__input--email' name='email' placeholder='Email address' pattern='^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$'>
					<label class='form__error'>Please enter a valid email address</label>
					<input type='password' class='form__input form__input--password' name='password' placeholder='Password' minlength='8' maxlength='64'>
					<label class='form__error'>Password must be 8 - 64 characters</label>
					{$submit_button}
					{$cancel_button}
				</div>								
			</form>
			<p class='form__forgotten-password'><a class='form__forgotten-password-link' href='$forgotten_pw_url'>Forgot password?</a></p>
			<p class='form__error form__error--submission'>No Error</p>
		</div>";

return $out;
