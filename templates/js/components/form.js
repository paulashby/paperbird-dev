import {dataAttrClickHandler} from '../helpers';

let setup = {
};
let actions = {
    validateOnBlur: function (form_selector) {

        $(form_selector).focus(function(e) {
            $(this).blur(function() { 
               $(this).addClass('activated'); 
            });
        });   
    }
};

function init (settings) {

	// Store for validateForm() which is also called by actions.cancel() 
	setup.form_selector = '.' + settings.validate;
    actions.validateOnBlur(setup.form_selector);

    // Use event handlers in actions object
    $('.form').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });

    actions.cancel = function (e) {
        // Hide error messages then reset fields
        let submitting_form = $(e.target).closest('form');

        // Hide previous submission message
        submitting_form.parent().find('.form__error--submission').removeClass('form__error--show');

        // No error highlighting on first visit to fields
        submitting_form.find('.form__input').removeClass('activated').off();

        // Reactivate validation
         this.validateOnBlur(setup.form_selector);

        // Reset form fields
        submitting_form.trigger( "reset" );
    };

    actions.submit = function (e) {

        let submitting_form = $(e.target).closest('form');
        let error_report = submitting_form.parent().find('.form__error--submission');
        let method = submitting_form.attr('method');
        let action = submitting_form.attr('action');
        let validated = isValid(submitting_form);

        if(validated ) {

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
        } else {
            //TODO: Display invalid form message
            console.warn('form data is invalid');
        }

        // Let jQuery submit the form
        e.preventDefault();
    };
}

function isValid (form) {

    let toValidate = $(form).find('.form__input');   
    
    if(toValidate.length) {

        // Can exit for of loop with return
        for (let input_field of toValidate) {

          if ( ! $(input_field).val() || ! $(input_field).is(":valid")) {

                return false;

            }
        }
        return true;
    }
} 


const form = {
    init: init
};

export default form;