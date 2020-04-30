function init (settings) {

    $('.' + settings.button_class).on('click', function (e) {

        if(settings.resetNavDropdown) {

            settings.resetNavDropdown();

        }
       
        // animate button
        $('.' + settings.toggle_bar_class).each(function(){

            $(this).toggleClass(settings.toggle_bar_class + '--active');

        });

        // toggle menu - using body element for this so we can disable scrolling
        $('body').toggleClass(settings.top_level_class + '--active');

    });
}

const menu = {
    init: init
};

export default menu;