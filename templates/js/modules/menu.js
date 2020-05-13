let setup = {
    top_level_class: 'menu__entries',
    toggle_bar_class: 'menu__bar',
    search_class: 'menu__entrybutton--search'
};

function init (settings) {

    $('.menu__button').on('click', function (e) {

        console.log('open menu button clicked');
        openMenu(settings);

    });

    $('.menu__entries').on('click', function (e) {

        if( ! settings.isNavigationEvent(e)){

            // Menu event
            // Switch isn't cutting it - we need .hasClass, as class list also contains 'menu__entrybutton'
            switch ($(e.target).attr('class')) {

                case setup.search_class:
                console.log('search clicked');
                break;

                default:
                console.log('.' + $(e.target).attr('class') + ' clicked')
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