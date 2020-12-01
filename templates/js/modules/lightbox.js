import {doAction, dataAttrClickHandler} from '../helpers';

let setup = {
    success_callbacks : {
        populateLightbox: function (data) {
            $('.card-viewer').html(data);
        }
    }
};
let actions = {
};

function init (settings) {

    $('.products').on('click', function (e) {
        
        dataAttrClickHandler(e, actions);

    });

    actions.openLightbox = function (e) {

        populateLightbox(e.target.dataset.sku);
    };
    actions.showProduct = function (e) {

        populateLightbox(e.target.dataset.sku);
    };
    actions.closeLightbox = function (e) {

        $('.card-viewer').empty();
    };

    /*
    'updateCart' event is dispatched by ordercart.js
    with action property of 'add', 'remove', 'update' or 'order'
    */
    $(document).on('updateCart', function(e) {
        // We actually want to display a message at this point
        if(e.action === 'add') {
            actions.closeLightbox(e);
        }
    });
}
function populateLightbox(sku) {

    let settings = {
        ajaxdata: {
            action: 'populateLightbox',
            sku: sku
        },
        callback: setup.success_callbacks.populateLightbox,
        action_url: config.ajaxURL
    };

    doAction(settings);
}

function respond (e, action) {
    if(actions[action]) {
        actions[action](e);
    }
}

const lightbox = {
    init: init
};    

export default lightbox;