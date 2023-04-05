<?php

include_once("./_func.php");

if($page->template->name === 'services-forgotten-password') {

	$wire->addHookBefore('Inputfield::render', function($event) {
		
		$inputfield = $event->object;

		if($inputfield instanceof InputfieldText) {

			$inputfield->addClass('form__input form__input--validate form__input--email');

		} else if($inputfield instanceof InputfieldSubmit) {
			// submit button
			$inputfield->addClass('form__button form__button--submit');
		}
	}); 
	$wire->addHookBefore('ProcessForgotPassword::renderForm', function($event) {

		// Display message instead of form when reset complete
		if(wire('session')->pwreset) {
			$redirect_url = wire('pages')->get('template=pw-reset-confirm')->url;
			wire('session')->redirect($redirect_url); 
		}

		$form = $event->arguments(0);
		$form_name = $event->arguments(1);
		
		if($form_name == 'step3') {
			// set pwreset as ProcessForgotPassword doesn't update the step number on session
			wire('session')->pwreset = true;
		}
	}); 

}
