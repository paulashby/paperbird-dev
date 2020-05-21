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

function closeDropdown () {

    let expanded = $('li.nav__level-1--active');

    if(expanded.length) {

        expanded.each(function(){

            $(this).removeClass('nav__level-1--active');

        });
        return true;
    }
    // No expanded dropdowns - must be closing menu
    return false;
}
function toggleSubmenu (e) {

    if ($(e.target).hasClass('nav__top-cat')) {

        toggleDropdown(e);
        return true;
    }

    return false;

}

function navigationClick (e) {

    let event_type = {
        page_link: false,
        toggle_dropdown: false
    };

    if($(e.target).hasClass('nav__top-link')) {

        event_type.page_link =  true;
        return event_type;

    } else if ($(e.target).hasClass('nav__top-cat')) {

        toggleDropdown(e);
        event_type.toggle_dropdown =  true;
        return event_type;
    }

    return false;

}

const navigation = {
    init: init,
    resetDropdown: resetDropdown,
    closeDropdown: closeDropdown,
    navigationClick: navigationClick
};    

export default navigation;