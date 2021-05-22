import {doAction, dataAttrClickHandler} from '../helpers';
import {getBreakpoint} from '../helpers';
import form from '../components/form';

let setup = {
    success_callbacks : {
        populateCart: function (data) {

            let cart_items_elmt = $('.cart-items');
            cart_items_elmt.removeClass('cart-items--empty');

            if( ! data.count){
                cart_items_elmt.addClass('cart-items--empty');
            }

            cart_items_elmt.html(data.markup);
            setup.lazyLoad.update();
        }
    },
    top_level_class: 'menu__entries',
    toggle_bar_class: 'menu__bar',
    button_prefix: 'button--'
};
let menu_modifier = '';
let actions = {
};

function init (settings) {

    setup.base_menu_class = $('.menu').attr('class');
    setup.lazyLoad = settings.lazyLoad;
    setup.cartClosesMenu = settings.cartClosesMenu;

    // Use event handlers in actions object
    $('.menu').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });

    actions.toggleMenu = function (e) {

        $(e.target).trigger('dropdownResetEvent');
   
        // animate button
        $('.' + setup.toggle_bar_class).each(function(){

            $(this).toggleClass(setup.toggle_bar_class + '--active');

        });

        // toggle menu - using body element for this so we can disable scrolling
        $('body').toggleClass(setup.top_level_class + '--active');

        let current_breakpoint = getBreakpoint();

        if(current_breakpoint.indexOf('small') >= 0) {
            // Now using jquery to position menu as using a class triggers the ccs animation when crossing breakpoints
            let main_menu = $('.' + setup.top_level_class);
            // let new_position = main_menu.position().left < 0 ? 0 : - $(window).width();
            let new_position = main_menu.position().left < 0 ? 0 : - $(window).width();


            main_menu.animate({left: new_position}, 500, function() {
                if(new_position < 0) {
                    // Remove style as css style is now positioning to vw - else menu is visible when screen is resized
                    main_menu.removeAttr('style');
                }
            });

        }
        // reset menu class - this removes classes associated with state of any active menu elements  such as login, basket, search
        $('.menu').removeClass().addClass(setup.base_menu_class);
    };
    actions.toggleMenuDisplay = function (e) {

        if($('.menu').hasClass('menu--modal-active') || settings.sliding || ! settings.hasNav) {

            // Simple menu toggle
            this.toggleMenu(settings, e);

        } else {

            // Intention may be to close a dropdown
             $(e.target).trigger('dropdownCloseEvent');

         }
    };
    actions.toggleTool = function (e) {

        let tool_toggle = $(e.target).data('buttontype');
            
        if(tool_toggle) {

            // Toggling a menu tool - store button type so we can manipulate menu class post-animation
            menu_modifier = tool_toggle;

            // add class to change state of target element
            $('.menu').removeClass().addClass(setup.base_menu_class + ' menu--modal-active menu--' + menu_modifier);

            if($(e.target).data('buttontype') === 'cart') {

                let settings = {
                    ajaxdata: {
                        action: 'populateCart'
                    },
                    callback: setup.success_callbacks.populateCart,
                    action_url: config.ajaxURL
                };

                doAction(settings);
                
            }

        }
    };
    actions.logInOut = function (e) {

        if($('body').hasClass('logged-in')) {

            $(e.target).trigger('logOutEvent', [e]);

        } else {

            this.toggleTool(e);
        }
    };
    actions.cancel = function (e) {

        $('.menu').removeClass('menu--modal-active');

        // leave modifier class in place until end of animation - this allows us to listen for changes to menu--[modifier] and avoid triggering the collapse animations for other menu tool elements
        $('.' + menu_modifier).one('animationend', function () {
            $('.menu').removeClass('menu--' + menu_modifier);
            // Remove listener
            $(e.target).off();

            if(setup.cartClosesMenu  && $(e.target).parent().attr('class') === 'cart'){
                actions.toggleMenu(e);
            }
        });
    };

    $(document).on('menuToggleEvent', function(settings, source_event) {

        let current_breakpoint = getBreakpoint();

        if(current_breakpoint.indexOf('medium') >= 0) {
            $('.menu').removeClass('menu--modal-active');
        } else {
            actions.toggleMenu(source_event);
        }
    });

    form.init({
        validate: 'form__input'
    });
}

const menu = {
    init: init
};

export default menu;