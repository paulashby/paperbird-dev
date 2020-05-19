import insertionQ from '../vendor/insertionQuery/insQ.min';
import validate from '../utilities/simpleValidation.js';

function init (settings) {

	validate({
		field_class: settings.field_class,
		error_class: settings.error_class
	});

	// Add class when label appended - using insertionQuery as css animation doesn't otherwise run due to browser optimising appending element then adding class into single reflow
    insertionQ('label.form__error, p.form__error').every(function(element){
		$(element).addClass('form__error--show');
	});
}

const form = {
    init: init
};

export default form;