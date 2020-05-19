/**
 * @param {Object} options
 * @param {string} options.field_class class of inputs to validate
 * @param {string} options.error_class class to apply to error message element
 */
function validate (options) {
	
	let form_selector = ('.' + options.field_class);

	$(form_selector).focus(function(e) {
		
		if($(this).hasClass('activated')) {
			// User revisiting field - provide dynamic feedback input
			showStatus(this);
		} else {
			// First visit to field - provide feedback when leaving
			$(this).addClass('activated');
			$(this).blur(function() { updateHighlighting(this); });
		}
	});
}

let validations = {
 	email: function (email) {
	  let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	  return re.test(email);
	}
}

function showStatus(field) {
	
	$(field).on('input', function() { updateHighlighting(this); });

}
function updateHighlighting (field) {

	let user_data = $(field).val();
 	let field_type = $(field).attr('type');

 	if(validValue(user_data, field_type)) {
		unhighlight(field);
	} else {
		highlight(field);
	}
}
function highlight (field) {
	$(field).next('.form__error').addClass('form__error--show');
}
function unhighlight (field) {
	$(field).next('.form__error').removeClass('form__error--show');
}
function validValue (user_data, field_type) {

	if(validations[field_type]) {
		return (validations[field_type](user_data));
	} else {
		console.warn('Validation function unavailable for ' + field_type + ' field');
	}
}
export default validate;