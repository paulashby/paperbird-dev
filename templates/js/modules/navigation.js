import {dataAttrClickHandler} from '../helpers';
import {getBreakpoint} from '../helpers';

let setup = {
    slide_duration: 300,
    top_cats: $('.nav__top-cat'),
    top_cat: 'nav__top-cat',
    top_cat_active: 'nav__top-cat--active',
    dropdown: 'nav__dropdown',
    level_1_class_active: 'nav__level-1--active',
    hide_scrollbars: 'hide-scrollbars',
    sliding: $('.nav').hasClass('nav--sliding')
};
let actions = {
};

function init (settings) {

    // Use event handlers in actions object
    $('.nav').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });

    
    // Need to use event delegation for this else the listener isn't attached to the hidden element
    $('.' + setup.top_cat).on({
        mouseenter: onMouseenter,
        mouseleave: onMouseleave
    });
    $('.' + setup.dropdown).on({
        mouseenter: onMouseenter,
        mouseleave: onMouseleave
    });

    actions.toggleDropdown = function (e) {

        $(setup.top_cats).each(function(){
            
            if(this === e.target) {
           
                if(setup.sliding) {
                    $(this).toggleClass(setup.top_cat_active).siblings().slideToggle(setup.slide_duration);    
                } 
                
                else {
                    // Hide scrollbars during animation
                    $('body').toggleClass(setup.hide_scrollbars);
                    // Attach event handler to run once only
                    $(this).parent().one('animationend', function () {
                        $('body').removeClass(setup.hide_scrollbars);
                        // Remove handler
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

        if(settings.menu){
            $('.menu').removeClass('menu--modal-active');
        }

        e.preventDefault();
    };

    // Menu triggers this event only when nav exists and we need to check for open dropdowns before toggling menu
    $(document).on('dropdownCloseEvent', function(e) {
        closeDropdown(e);
    });

    // Triggered when menu is toggled
    $(document).on('dropdownResetEvent', function(e) {
        resetDropdown(e);
    });
}

function onMouseenter (e) {
    
    let current_breakpoint = getBreakpoint();

    if(current_breakpoint.indexOf('small') < 0) {

        let dropdown_classes = ['show-dropdown'];
        let cat = $(e.target).data('cat');
        dropdown_classes.push('show-' + cat);

        $('body').addClass(dropdown_classes);
    }
}

function onMouseleave (e) {

    let current_breakpoint = getBreakpoint();

    if(current_breakpoint.indexOf('small') < 0) {

        let dropdown_classes = ['show-dropdown'];
        dropdown_classes.push('show-' + $(e.target).data('cat'));

        $('body').removeClass(dropdown_classes);
    }
}

function toggleDropdown (e) {
    
 console.warn('now actions.toggleDropdown')  
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