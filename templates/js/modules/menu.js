let setup = {
    slide_duration: 300,
    top_level_class: 'menu__entries',
    button_class: 'menu__button',
    toggle_bar_class: 'menu__bar'
};

function init (settings) {

    $('.' + setup.button_class).on('click', function (e) {

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
}

const menu = {
    init: init
};

export default menu;