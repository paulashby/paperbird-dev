import {doAction, dataAttrClickHandler} from '../helpers';

let setup = {
    success_callbacks : {
        populateLightbox: function (data) {
            $('.card-viewer').html(data);
            $('.lightbox').removeClass('lightbox--collapsed').addClass('lightbox--expanded');
        }
    }
};
let actions = {
};

function init (settings) {

    setup.cartAddClosesLightbox = settings.cartAddClosesLightbox;

    $('.products').on('click', function (e) {
        dataAttrClickHandler(e, actions);
    });

    actions.openLightbox = function (e) {
        $('body').addClass('show-lightbox');
        populateLightbox(e.target.dataset.sku);
    };
    actions.showProduct = function (e) {

        populateLightbox(e.target.dataset.sku);
    };
    actions.closeLightbox = function (e) {
        $('body').removeClass('show-lightbox');
        $('.lightbox').removeClass('lightbox--expanded').addClass('lightbox--collapsed');
    };
    actions.flip = function (e) {
        $('body').toggleClass('flip-card');
    }

    /*
    'updateCart' event is dispatched by ordercart.js
    with action property of 'add', 'remove', 'update' or 'order'
    */
    $(document).on('updateCart', function(e) {
        
        if(e.action === 'add') {
            if(setup.cartAddClosesLightbox) {
                actions.closeLightbox(e);
            } else {
                $('.lightbox_message').fadeIn().delay(1500).fadeOut(200);
            }
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

const lightbox = {
    init: init
};    

export default lightbox;