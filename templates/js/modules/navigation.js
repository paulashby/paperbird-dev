let setup = {
    slide_duration: 300,
    top_cats: $('.nav__top-cat'),
    top_cat_active: 'nav__top-cat--active',
    level_1_class_active: 'nav__level-1--active',
    hide_scrollbars: 'hide-scrollbars',
    sliding: $('.nav').hasClass('nav--sliding')
};

function init (settings) {

    // Add listener if navigation is not part of greater menu system
    if( ! settings.menu ) {

         $('.nav').on('click', function (e) {

            if($(e.target).hasClass('nav__top-cat')){

                toggleDropdown(e);

            } 
            e.preventDefault();
        });
     } else {
        
        // Listen for custom events
        $(document).on('menuClickEvent', function(e, source_event) {

            if($(e.target).hasClass('nav__top-link')) {

                return;
                
            } 
            if ($(e.target).hasClass('nav__top-cat')) {

                // Make event for this
                // Hide any modal menus which might be open in front of nav dropdown
                toggleDropdown(e);
                $('.menu').removeClass('menu--modal-active');

            } else {
                $(e.target).trigger('menuUpdateEvent');
            }
            source_event.preventDefault();
        });

        $(document).on('dropdownToggleEvent', function(e) {
            toggleDropdown(e);
        });

        $(document).on('dropdownCloseEvent', function(e) {
            closeDropdown(e);
        });

        $(document).on('dropdownResetEvent', function(e) {
            resetDropdown(e);
        });
     }

}

function toggleDropdown (e) {
    
    // Toggle dropdown menu
    $(setup.top_cats).each(function(){
        
        if(this === e.target) {
       
            if(setup.sliding) {
                $(this).toggleClass(setup.top_cat_active).siblings().slideToggle(setup.slide_duration);    
            } 
            else {
                // Hide scrollbars during animation
                $('body').toggleClass(setup.hide_scrollbars);
                $(this).parent().one('animationend', function () {
                    $('body').removeClass(setup.hide_scrollbars);
                    // Remove listener
                    $(this).off();
               });

            }

            $(this).parent().toggleClass(setup.level_1_class_active);

        } else {

            if(setup.sliding) {
                $(this).removeClass(setup.top_cat_active).siblings().slideUp(setup.slide_duration);
            }
            $(this).parent().removeClass(setup.level_1_class_active);

        }                   
    });   
}

function resetDropdown () {

    let reset_func = setup.sliding ? 
        function(){
            $(this).parent().removeClass(setup.level_1_class_active);
            $(this).removeClass(setup.top_cat_active).siblings().slideUp(setup.slide_duration);
        }
        : function(){
            $(this).removeClass(setup.top_cat_active);
        };

    $(setup.top_cats).each(function(){

        reset_func.call(this);

    });

    $('nav').attr('class', $('nav').attr('class'));

}

function closeDropdown (e) {

    let expanded = $('li.nav__level-1--active');

    if(expanded.length) {

        expanded.each(function(){

            $(this).removeClass('nav__level-1--active');

        });
    } else {
        // No expanded dropdowns - must be closing menu
        $(e.target).trigger('menuToggleEvent', [e]);
    }
}
function toggleSubmenu (e) {

    if ($(e.target).hasClass('nav__top-cat')) {

        toggleDropdown(e);
        return true;
    }

    return false;

}
const navigation = {
    init: init
};    

export default navigation;