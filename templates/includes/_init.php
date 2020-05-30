<?php

include_once("./_func.php");

if($page->template->name === 'services-forgotten-password') {

	$wire->addHookBefore('Inputfield::render', function($event) {
		$inputfield = $event->object;

		if($inputfield instanceof InputfieldText) {

			$inputfield->addClass('form__input form__input--validate form__input--email');
			$inputfield->attr('pattern', '^([\w\-\.]+)@((\[([0-9]{1,3}\.){3}[0-9]{1,3}\])|(([\w\-]+\.)+)([a-zA-Z]{2,4}))$');

		} else if($inputfield instanceof InputfieldSubmit) {
			// submit button
			$inputfield->addClass('form__button form__button--submit');
		}
	}); 

	$this->addHookAfter('Inputfield::render', function(HookEvent $event) {
		  
		  $inputfield = $event->object;

		  $return = $event->return;

		  if($inputfield instanceof InputfieldText) {

			$return .= "<label class='form__error'>Please enter a valid email address</label>";

		}
		$event->return = $return;
		});

}
