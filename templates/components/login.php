<?php namespace ProcessWire;

// https://processwire.com/talk/topic/1716-integrating-a-member-visitor-login-form/

$urls = include $config->paths->templates . "utilities-urls.php";
// $form_processor = $urls["logInOutURL"];
$forgotten_pw_url = $urls["forgotPassword"];
$role = "login"; // This is used by form.js to select appropriate callback
$button_text = $user->isLoggedin() ? "Log out" : "Log in";

$login_button = $files->render('components/buttons/menuToolButton', ['button_text'=>$button_text, 'button_class'=>'menu__entrybutton menu__entrybutton--login', 'button_type'=>'login', 'action'=>'logInOut']);

$submit_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--submit', 'button_type'=>'submit', 'action'=>'submit']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'action'=>'cancel']);

$out = "<h2>{$login_button}</h2>
		<div class='login'>
			<form class='form form--login' action='{}' method='post' data-role='{$role}'>
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
