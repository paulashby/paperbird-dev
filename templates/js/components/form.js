import {doAction, dataAttrClickHandler} from '../helpers';

let setup = {
    success_callbacks : {
        'login': function (e, submitting_form, count) {
            if(window.location.pathname === config.forgotPassword) {
                // Go to homepage if this is forgotten password page as we clearly no longer need to reset password.
                window.location.replace(config.root); 
            } else {
                submitting_form.trigger('menuToggleEvent', [e]);
                $.event.trigger({
                    type: "updateCart",
                    action: "login",
                    count: count
                });
                $('body').addClass('logged-in');
                $('.menu__entrybutton--login').html('Log out');
            }
        },
        'logout': function (e) {
            $('body').trigger('menuToggleEvent', [e]);
            $('body').trigger('logoutEvent');
            $.event.trigger({
                type: "updateCart",
                action: "logout",
                count: 0
            });
            $('body').removeClass('logged-in');
            $('.menu__entrybutton--login').html('Log in');
        },
        'search': function (data) {
            $('.search').html(data);
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
    $('body').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });
        /*
    'updateCart' event is dispatched by ordercart.js
    with action property of 'add', 'remove', 'update' or 'order'
    */
    $(document).on('updateCart', function(e) {
        
        if(e.action === 'add') {
            $('.search_message').fadeIn().delay(1500).fadeOut(200);
        }
    });

    actions.submit = function (e) {

        //TODO: Should just be able to use doAction for this
        let submitting_form = $(e.target).closest('form');
        let validation = isValid(submitting_form);
        let error_report = submitting_form.parent().find('.form__error--submission');

        if(validation.success) {

            let method = submitting_form.attr('method');
            let role = submitting_form.data('role');

            $.ajax({
                type: method, 
                url: config.logInOutURL,
                data: submitting_form.serialize(),
                dataType: 'json',
                success: function(data) {
                    if(data.success === true) {
                        error_report.removeClass('form__error--show');
                        submitting_form.trigger( "reset" );
                        // Different callbacks will probably require different arguments
                        setup.success_callbacks[role](e, submitting_form, data["num_cart_items"]);

                    } else {
                        error_report.html(data.errors.join('<br>')).addClass('form__error--show');
                    }
               },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    throw new Error(errorThrown);
                } 
            });
        } else {

            error_report.html(validation.errors).addClass('form__error--show');

        }
        // Let jQuery submit the form
        e.preventDefault();
    };

    actions.search = function (e) {

        let settings = {
            ajaxdata: {
                action: 'search',
                q: $('#search_query').val()
            },
            callback: setup.success_callbacks.search,
            action_url: config.ajaxURL
        };

        doAction(settings);

        // Let jQuery submit the form
        e.preventDefault();
    };

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
                //TODO: Need to handle errors - error_report not available as this is part of hidden form
                // error_report.html(data.errors.join('<br>')).addClass('form__error--show');
                console.log(data);
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