let setup = {
    slide_duration: 300,
    top_cats: $('.nav__top-cat'),
    top_cat_active: 'nav__top-cat--active',
    level_1_class_active: 'nav__level-1--active',
    sliding: $('.nav').hasClass('nav--sliding')
};

function init (settings) {

    $('.menu').on('click', function (e) {

        if($(e.target).hasClass('nav__top-cat')){

            // Toggle dropdown menu
            $(setup.top_cats).each(function(){
                
                if(this === e.target) {
               
                    if(setup.sliding) {
                        $(this).toggleClass(setup.top_cat_active).siblings().slideToggle(setup.slide_duration);    
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
        e.preventDefault();
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

const navigation = {
    init: init,
    resetDropdown: resetDropdown,
    closeDropdown: closeDropdown
};    

export default navigation;