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
        openMenu(settings);

    });

    $('.menu__entries').on('click', function (e) {

        if( ! settings.toggleSubmenu(e)){

            let tool_toggle = $(e.target).data('buttontype');
            
            if(tool_toggle) {

                // Toggling a menu tool - store button type so we can manipulate menu class post-animation
                menu_modifier = tool_toggle;

                // add class to change state of target element
                $('.menu').removeClass().addClass(setup.base_menu_class + ' menu--modal-active menu--' + menu_modifier);

            } else {
                
                if($('.menu').hasClass('menu--modal-active')) {
                    //TODO: refactor so this is first in function?
                    // Ignore if click is on field
                    if( ! $(e.target).hasClass('form__input')) {

                        processForm(e);

                    }
                } else {

                    console.log('Standard link - load page');

                }
            }

        } else {

            // Submenu is being toggled - close modal menu if it's open
            $('.menu').removeClass('menu--modal-active');
        } 
        e.preventDefault();
    });

    form.init({
        validate: 'form__input--validate',
        error_class: 'form__error'
    });
}
function toggleMenu (settings) {

    if(settings.resetNavDropdown) {

        settings.resetNavDropdown();

    }
   
    // animate button
    $('.' + setup.toggle_bar_class).each(function(){

        $(this).toggleClass(setup.toggle_bar_class + '--active');

    });

    // toggle menu - using body element for this so we can disable scrolling
    $('body').toggleClass(setup.top_level_class + '--active');

    // reset menu class - this removes classes associated with 
    // state of any active menu elements  such as login, basket, search
    $('.menu').removeClass().addClass(setup.base_menu_class);

}

function openMenu (settings) {

    if($('.menu').hasClass('menu--modal-active')){

        // Simple menu toggle
        toggleMenu(settings);

    } else if(settings.sliding) {

        // Simple menu toggle
        toggleMenu(settings);

    } else {

        // Intention may be to close a dropdown

        // closeNavDropdown function should be available if menu dropdowns are not set to slide
        if(settings.closeNavDropdown) {

            // closeNavDropdown() will look after dropdowns.
            // We need to act only if false is returned, telling us
            // there are no expanded dropdowns and intention of click 
            // must have been to toggle the whole menu.
            if( ! settings.closeNavDropdown()) {

                toggleMenu(settings);
            }

        } else {
            
            console.error('Expected closeNavDropdown function from main.js - none provided');
        }
    }
}

function closeModalMenu (e) {

    $('.menu').removeClass('menu--modal-active');

    // leave modifier class in place until end of animation - this allows us to listen for changes to menu--[modifier]
    // and avoid triggering the collapse animations for other menu tool elements
    $('.' + menu_modifier).one('animationend', function () {
        $('.menu').removeClass('menu--' + menu_modifier);
        // Remove listener
        $(e.target).off();
   });
}
function processForm(e) {

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
    }

}

const menu = {
    init: init
};

export default menu;