function init (settings) {

    $('.' + settings.toggle_switch_class).on('click', function (e) {

        if(settings.resetNavDropdown) {

            settings.resetNavDropdown();

        }

        // animate button
        $('.' + settings.toggle_bar_class).each(function(){

            $(this).toggleClass(settings.toggle_bar_class + '--active');

        });

        // toggle menu - using body element for this so we can disable scrolling
        $('body').toggleClass(settings.top_level_class + '--active');

        // remove colour class
        $('.' + settings.menu_class).attr('class', settings.menu_class);


    });
}

const menu = {
    init: init
};

export default menu;