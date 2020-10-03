import {doAction} from '../helpers';

let setup = {
    success_callbacks : {
        toggleLightbox: function (data) {
            $('.card-viewer').html(data);
        }
    }
};
let actions = {
};

function init (settings) {

    // Use event handlers in actions object
    $('.product').on('click', function (e) {
        
        // Not using helpers dataAttrClickHandler as it uses e.target rather than e.currentTarget
        let action = $(e.currentTarget).data('action');

        if(actions[action]) {
            actions[action](e);
        }
    });

    actions.toggleLightbox = function (e) {

        //TODO: This isn't toggling at the moment, just loading - probably need to split this into toggle and load content

        let settings = {
            ajaxdata: {
                sku: e.currentTarget.dataset.sku
            },
            callback: setup.success_callbacks.toggleLightbox,
            action_url: window.location.href
        };
        // This might as well directly call make request (maybe rename that as doAction or might this lead to confusion as it differs from the orderCart doAction - nah, just comment it to this effect)... in fact, looking at it, seems maybe the two functions in cart.js could be streamlined into a single one.
        doAction(settings);
    };
}

const lightbox = {
    init: init
};    

export default lightbox;