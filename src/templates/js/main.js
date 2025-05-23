import $ from 'jquery';
import errorHandler from './utilities/errorHandler';
import menu from './modules/menu';
import navigation from './modules/navigation';
import lightbox from './modules/lightbox';
import cart from './modules/cart';
import blog from './modules/blog';
import artist from './modules/artist';
import colSorter from './modules/colSorter';
import LazyLoad from './vendor/lazyload.esm';

const debouncedResizeEvent = new Event('debouncedResize');
let debounce;

let lazyLoad = new LazyLoad({
  elements_selector: '.lazy',
  threshold: 150,
  cancel_on_exit: true
});

window.jQuery = $;
window.$ = $;

$(function() {
    init();
});

function init () {

    const sliding = $('.nav').hasClass('nav--sliding');

	const error_handler_settings = {
		url: config.errorHandlerURL
	};

	const nav_settings = {
		menu: menu,
		sliding: sliding
	}

	const menu_settings = {
		loginClosesMenu: false,
		cartClosesMenu: false,
		lazyLoad: lazyLoad,
		sliding: sliding,
		hasNav: true
	}

	const lightbox_settings = {
		cartAddClosesLightbox: true
	}

	const disableIosTextFieldZoom = addMaximumScaleToMetaViewport;

	// https://stackoverflow.com/questions/9038625/detect-if-device-is-ios/9039885#9039885
	const checkIsIOS = () =>
	  /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

	if (checkIsIOS()) {
		disableIosTextFieldZoom();
		$('body').addClass('ios');
	}

    window.addEventListener('resize', () => {

        clearTimeout(debounce);
        $('body').addClass('resizing');

        debounce = setTimeout(() => {
            $('body').removeClass('resizing');

            if ($('body').hasClass('home')) {
                setFaireWidgetSrc();
            }

            window.dispatchEvent(debouncedResizeEvent);
        }, 250);
    });

	errorHandler.init(error_handler_settings);
	menu.init(menu_settings);
	navigation.init(nav_settings);
	lightbox.init(lightbox_settings);
	cart.init();

	if ($('body').hasClass('home')) {
		setFaireWidgetSrc();
	} else if ($('body').hasClass('notebook')) {
		blog.init();
	} else if ($('body').hasClass('artist')){
		// Pass in lazyLoad instance so we can update after ajax load
		artist.init(lazyLoad);
	} else if ($('body').hasClass('whats-on')){

		let col_sorter_settings = {
			container: 'gp__content',
			col_item: 'event-entry',
			sort_point: 650
		}

		colSorter.init(col_sorter_settings);

	}
}

const setFaireWidgetSrc = () => {
    const currentWidth = $(document).innerWidth();

    const faireWidgetAttributes = new Map();
    faireWidgetAttributes.set(900, {
        urlSegment: 'bw_j3qqrnn2mj',
        width: '900',
        height: '600',
        style: 'margin:0 auto;border:none;display:block;max-width:100%;width:900px;height:600px;'
    });
    faireWidgetAttributes.set(500, {
        urlSegment: 'bw_gyk4ma5de5',
        width: '500',
        height: '600',
        style: 'margin:0 auto;border:none;display:block;max-width:100%;width:500px;height:600px;'
    });
    faireWidgetAttributes.set(0, {
        urlSegment: 'bw_ehcu3ehwp3',
        width: '360',
        height: '64',
        style: 'margin:0 auto;border:none;display:block;max-width:100%;width:360px;height:64px;'
    });

    for (const [key, value] of faireWidgetAttributes) {
        if (currentWidth >= key) {
            const faireWidget = $('#faire-widget');

            if (faireWidget.length === 0) {
                console.warn('Faire widget not found');
            } else {
                const {urlSegment, ...otherAttribs} = faireWidgetAttributes.get(key);
                faireWidget.attr({
                    src: `https://www.faire.com/embed/${urlSegment}`,
                    ...otherAttribs
                });
            }
            break;
        }
    }
};

// https://stackoverflow.com/questions/2989263/disable-auto-zoom-in-input-text-tag-safari-on-iphone
const addMaximumScaleToMetaViewport = () => {
  const el = document.querySelector('meta[name=viewport]');

  if (el !== null) {
    let content = el.getAttribute('content');
    let re = /maximum\-scale=[0-9\.]+/g;

    if (re.test(content)) {
        content = content.replace(re, 'maximum-scale=1.0');
    } else {
        content = [content, 'maximum-scale=1.0'].join(', ')
    }

    el.setAttribute('content', content);
  }
};
