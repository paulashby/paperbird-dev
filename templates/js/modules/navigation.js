let setup = {
    slide_duration: 300
};

function init (settings) {

    setup.top_cat_active = settings.top_cat_class + '--active';
    setup.level_1_class_active = settings.level_1_class + '--active';
    setup.top_cats = $('.' + settings.top_cat_class);
    setup.to_colourise = settings.colorise_class;

    $('.menu').on('click', function (e) {

        if($(e.target).hasClass(settings.top_cat_class)){

            // Toggle dropdown menu and change nav bg colour for mobile
            $(setup.top_cats).each(function(){
                
                if(this === e.target) {
                
                    // TODO: Only if buttoned
                    $(this).toggleClass(setup.top_cat_active).siblings().slideToggle(setup.slide_duration);
                   

                    $(this).parent().toggleClass(setup.level_1_class_active);

                    // Rotate superscript plus button if required
                    // $(this).toggleClass(setup.top_cat_active);


                } else {

                    $(this).removeClass(setup.top_cat_active).siblings().slideUp(setup.slide_duration);
                    $(this).parent().removeClass(setup.level_1_class_active);

                    // Rotate superscript plus button if required
                    $(this).removeClass(setup.top_cat_active);

                }                   
            });

        } 
        // else {
        //     console.log($(e.target).attr("href"));
        // } 
        else if($(e.target).hasClass(settings.top_link_class)) {

            // Only if buttoned
            $(setup.top_cats).siblings().slideUp(setup.slide_duration);

        }
        

        // Hide siblings when top level category clicked
        // if(e.target.dataset.cat) {
        //     $('.nav').toggleClass(setup.top_cat_active); 
        // }

        e.preventDefault();
    });
}


function colourise (colour_class) {

    // Can't simply toggle as colour_class could include the name of any of our top categories

    let elmt_class_name = '.' + setup.to_colourise;

    if($(elmt_class_name).hasClass(colour_class)){

        $(elmt_class_name).removeClass(colour_class);  

    } else {

        $(elmt_class_name).attr('class', setup.to_colourise).addClass(colour_class);

    }

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