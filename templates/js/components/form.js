//TODO: Do we need to import jquery if it doesn't exist?

import insertionQ from '../vendor/insertionQuery/insQ.min';
import validate from '../vendor/jquery-validation-1.19.1/dist/jquery.validate.min';

/*
 * Settings has two properties - 
 * String: error_class
 * String or Array of Strings: form_classes
*/
function init (settings) {

	let form_list = settings.form_classes;

	// Apply form validation
    if (Array.isArray(form_list)) {

    	form_list.forEach (form_name => applyValidation(settings.error_class, form_name));

    } else {
    		applyValidation(settings.error_class, form_list);
    }

    // Add class when label appended - doing it via insertionQuery as css animation doesn't otherwise run due to browser optimising appending element then adding class into single reflow
    insertionQ('label.form__error, p.form__error').every(function(element){
		$(element).addClass('form__error--show');
	});
}

/*
 * String: error_class - the class to apply to the error message element (which is a label by default)
 * String or Array of Strings: form_classes (the classes of all forms on page requiring validation)
*/
function applyValidation(error_class, form_class) {
	$('.' + form_class).validate({
			errorClass: error_class,
			highlight: function (element, required) {
				$(element).addClass('form__input--highlight');
		    },
		    unhighlight: function (element, errorClass, validClass) {
		    	$(element).removeClass('form__input--highlight');
		    }
		}
    );
}

const form = {
    init: init
};

export default form;