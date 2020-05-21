import form from '../components/form';

let setup = {
    top_level_class: 'menu__entries',
    toggle_bar_class: 'menu__bar',
    button_prefix: 'button--'
};
let menu_modifier = '';

function init (settings) {

    setup.button_prefix_len = setup.button_prefix.length;
    setup.base_menu_class = $('.menu').attr('class');

    $('.menu__button').on('click', function (e) {

        console.log('toggle menu button clicked');
        openMenu(settings, e);

    });

    $('.menu__entries').on('click', function (e) {

        //TODO: users with js disabled won't see the dropdown menus. Could make the parent pages viewable so that when preventDefault isn't called, the parent page loads with links to to the children.
         
        if(settings.hasNav) {
            // Trigger event for navigation
            $(e.target).trigger('menuClickEvent', [e]);
        } else {
            updateMenu(e);

            if ($(e.target).hasClass('nav__top-cat')) {

                $(e.target).trigger('dropdownToggleEvent');

            }
            e.preventDefault();
        }
    });

    // Listen for custom events
    $(document).on('menuUpdateEvent', function(e) {
        updateMenu(e);
    });

    $(document).on('menuToggleEvent', function(settings, source_event) {
        toggleMenu(settings, source_event);
    });

    form.init({
        validate: 'form__input--validate',
        error_class: 'form__error'
    });
}

function updateMenu (e) {

    let tool_toggle = $(e.target).data('buttontype');
            
    if(tool_toggle) {

        // Toggling a menu tool - store button type so we can manipulate menu class post-animation
        menu_modifier = tool_toggle;

        // add class to change state of target element
        $('.menu').removeClass().addClass(setup.base_menu_class + ' menu--modal-active menu--' + menu_modifier);

    } else {
        
        if($('.menu').hasClass('menu--modal-active')) {
            
            if( ! $(e.target).hasClass('form__input')) {

                processForm(e);

            }
        }
    }
}

function toggleMenu (settings, e) {

    $(e.target).trigger('dropdownResetEvent');
   
    // animate button
    $('.' + setup.toggle_bar_class).each(function(){

        $(this).toggleClass(setup.toggle_bar_class + '--active');

    });

    // toggle menu - using body element for this so we can disable scrolling
    $('body').toggleClass(setup.top_level_class + '--active');

    // reset menu class - this removes classes associated with state of any active menu elements  such as login, basket, search
    $('.menu').removeClass().addClass(setup.base_menu_class);

}

function openMenu (settings, e) {

    if($('.menu').hasClass('menu--modal-active') || settings.sliding) {

        // Simple menu toggle
        toggleMenu(settings, e);

    } else {

        // Intention may be to close a dropdown
         $(e.target).trigger('dropdownCloseEvent');
     }
}

function closeModalMenu (e) {

    $('.menu').removeClass('menu--modal-active');

    // leave modifier class in place until end of animation - this allows us to listen for changes to menu--[modifier] and avoid triggering the collapse animations for other menu tool elements
    $('.' + menu_modifier).one('animationend', function () {
        $('.menu').removeClass('menu--' + menu_modifier);
        // Remove listener
        $(e.target).off();
   });
}

function processForm(e) {

    let attr_val = $(e.target).attr('value');

    if(attr_val) {

        switch ($(e.target).attr('value').toLowerCase()) {
            case 'cancel':
            closeModalMenu(e);
            form.reset(e);
            break;

            case 'submit':
            //TODO: Check for validation errors first
            form.submit(e);
            break;

            default:
            e.preventDefault();
            throw new Error('Unexpected value');

        }
    }
}

const menu = {
    init: init
};

export default menu;