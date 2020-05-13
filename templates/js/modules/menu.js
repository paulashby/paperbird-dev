let setup = {
    top_level_class: 'menu__entries',
    toggle_bar_class: 'menu__bar',
    button_prefix: 'button--'
};


function init (settings) {

    setup.button_prefix_len = setup.button_prefix.length;
    setup.base_menu_class = $('.menu').attr('class');

    $('.menu__button').on('click', function (e) {

        console.log('toggle menu button clicked');
        openMenu(settings);

    });

    $('.menu__entries').on('click', function (e) {

        if( ! settings.toggleSubmenu(e)){

            let button_type = $(e.target).data('buttontype');
            
            if(button_type) {

                // add class to change state of target element
                $('.menu').removeClass().addClass(setup.base_menu_class + ' menu--' + button_type);

            } else {
                console.log('Standard link - load page');
            }

        } 
        e.preventDefault();
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
    if(settings.sliding) {
        
        toggleMenu(settings);

    } else {

        // closeNavDropdown will be available if menu dropdowns are not set to slide
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

const menu = {
    init: init
};

export default menu;