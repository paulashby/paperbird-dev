let setup = {
    slide_duration: 300
};

function init (settings) {

    setup.top_cats = $('.nav__top-cat');
    setup.top_cat_active = 'nav__top-cat--active';
    setup.level_1_class_active = 'nav__level-1--active';
    setup.sliding = $('.nav').hasClass('nav--sliding');

    $('.menu').on('click', function (e) {

        if($(e.target).hasClass('nav__top-cat')){

            // Toggle dropdown menu and change nav bg colour for mobile
            $(setup.top_cats).each(function(){
                
                if(this === e.target) {
               
                    // Expand dropdown only if superscript buttoned links
                    if(setup.sliding) {
                        $(this).toggleClass(setup.top_cat_active).siblings().slideToggle(setup.slide_duration);    
                    }

                    $(this).parent().toggleClass(setup.level_1_class_active);

                } else {

                    $(this).removeClass(setup.top_cat_active).siblings().slideUp(setup.slide_duration);
                    $(this).parent().removeClass(setup.level_1_class_active);

                }                   
            });

        } 
        e.preventDefault();
    });
}

function resetDropdown () {

    // Reset dropdown menu
    $(setup.top_cats).each(function(){

        $(this).removeClass(setup.top_cat_active).siblings().slideUp(setup.slide_duration);

    });

    $('nav').attr('class', $('nav').attr('class'));

}

const navigation = {
    init: init,
    resetDropdown: resetDropdown
};    

export default navigation;