import {dataAttrClickHandler} from '../helpers';

let setup = {
    success_callbacks : {
        'login': function (e, submitting_form) {
            submitting_form.trigger('menuToggleEvent', [e]);
            $('body').addClass('logged-in');
            $('.menu__entrybutton--login').html('Log out');
        },
        'logout': function (e) {
            $('body').trigger('menuToggleEvent', [e]);
            $('body').removeClass('logged-in');
            $('.menu__entrybutton--login').html('Log in');
        }
    }
};
let actions = {
    validateOnBlur: function (form_selector) {

        $(form_selector).focus(function(e) {
            // Remove previous submission errors
            $(this).closest('.form').parent().find('.form__error--submission.form__error--show').removeClass('form__error--show');
            $(this).blur(function() { 
               $(this).addClass('activated'); 
            });
        });   
    }
};

function init (settings) {

	// Store for validateOnBlur() which is also called by actions.cancel() 
	setup.form_selector = '.' + settings.validate;
    actions.validateOnBlur(setup.form_selector);

    // Use event handlers in actions object
    $('.form').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });

    actions.cancel = function (e, form) {
        // Hide error messages then reset fields
        let submitting_form = form || $(e.target).closest('form');

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
        let validation = isValid(submitting_form);
        let error_report = submitting_form.parent().find('.form__error--submission');

        if(validation.success) {

            let method = submitting_form.attr('method');
            let action = submitting_form.attr('action');
            let role = submitting_form.data('role');

            $.ajax({
                type: method, 
                url: action,
                data: $(e.target).closest('form').serialize(),
                dataType: 'json',
                success: function(data) {
                    
                    if(data.success === true) {
                        error_report.removeClass('form__error--show');
                        submitting_form.trigger( "reset" );
                        // Different callbacks will probably require different arguments
                        setup.success_callbacks[role](e, submitting_form);

                    } else {
                        error_report.html(data.errors.join('<br>')).addClass('form__error--show');
                    }
               },
                error: function(jqXHR, textStatus, errorThrown) {
                    throw new Error(errorThrown);
                } 
            });
        } else {

            error_report.html(validation.errors).addClass('form__error--show');

        }
        // Let jQuery submit the form
        e.preventDefault();
    };

    $(document).on('logOutEvent', function(e) {
        logOut(e);
    });
}

function logOut (e) {

    let role = 'logout';

        $.ajax({
            type:'post', 
            url: config.logInOutURL,
            data: {logout: true},
            dataType: 'json',
            success: function(data) {
                
                if(data.success === true) {
                    // Do we need a call back?
                    setup.success_callbacks[role](e);

                } else {
                    error_report.html(data.errors.join('<br>')).addClass('form__error--show');
                }
           },
            error: function(jqXHR, textStatus, errorThrown) {
                throw new Error(errorThrown);
            } 
        });
    
}
function isValid (form) {

    let toValidate = $(form).find('.form__input');   
    
    if(toValidate.length) {

        // Can exit for of loop with return
        for (let input_field of toValidate) {

          if ( ! $(input_field).val() || ! $(input_field).is(':valid')) {

                return {success: false, errors: 'Please enter a valid ' + $(input_field).attr('type')};

            }
        }
        return {success: true};
    }
} 


const form = {
    init: init
};

export default form;