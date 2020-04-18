function init (settings) {

    $('.' + settings.button_class).on('click', function (e) {

        if(settings.resetNavDropdown) {

            settings.resetNavDropdown();

        }
       
        // Only animate button if it's a toggle - the open/close versions remain in place inchanged.
         // if($(e.currentTarget).hasClass(settings.toggle_switch_class)) {

            // animate button
            $('.' + settings.toggle_bar_class).each(function(){

                $(this).toggleClass(settings.toggle_bar_class + '--active');

            });
        // }

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