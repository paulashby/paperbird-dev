import validate from '../utilities/simpleValidation.js';

let setup = {
};

function init (settings) {

	// Store for validateForm() which is also called by reset() 
	setup.validate = settings.validate;
	setup.error_class = settings.error_class;

	validateForm();

}

function validateForm () {
	validate({
		field_class: setup.validate,
		error_class: setup.error_class
	});
}

function submit (e)	{

	let submitting_form = $(e.target).closest('form');
	let error_report = submitting_form.parent().find('.form__error--submission');
	let method = submitting_form.attr('method');
	let action = submitting_form.attr('action');

    $.ajax({
        type: method, 
        url: action,
        data: $(e.target).closest('form').serialize(),
        dataType: 'json',
        success: function(data) {
        	
        	if(data.success === true) {
        		console.log(data.message);
        		error_report.removeClass('form__error--show');
        		submitting_form.trigger( "reset" );
        		// switch login icon
        		// change text to logout
        		// close form - maybe close menu
        	} else {
        		error_report.html(data.errors.join('<br>')).addClass('form__error--show');
        	}
       },
        error: function(jqXHR, textStatus, errorThrown) {
        	throw new Error(errorThrown);
        } 
    });

// Let jQuery submit the form
e.preventDefault();

}

function reset (e) {
	// Hide error messages then reset fields
	let submitting_form = $(e.target).closest('form');

	// Hide visible highlighting
	submitting_form.parent().find('.form__error--submission').removeClass('form__error--show');
	submitting_form.find('.form__error--show').removeClass('form__error--show');

	// No error highlighting on first visit to fields
	// submitting_form.find('.form__input').removeClass('activated').off('blur', '**').off('input', '**');
	submitting_form.find('.form__input').removeClass('activated').off();

	// Reactivate validation
	validateForm();

	// Reset form fields
	submitting_form.trigger( "reset" );
}

const form = {
    init: init,
    submit: submit,
    reset: reset
};

export default form;