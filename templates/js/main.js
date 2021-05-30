import $ from 'jquery';
import errorHandler from './utilities/errorHandler';
import menu from './modules/menu';
import navigation from './modules/navigation';
import lightbox from './modules/lightbox';
import cart from './modules/cart'; 
import LazyLoad from './vendor/lazyload.esm';

let lazyLoad = new LazyLoad({
  elements_selector: ".lazy",
  threshold: 150,
  cancel_on_exit: true
});

window.jQuery = $;
window.$ = $;

$( document ).ready(function() {
	init();
});

function init () {

	let sliding = $('.nav').hasClass('nav--sliding');

	let error_handler_settings = {
		url: config.errorHandlerURL
	};

	let nav_settings = {
		menu: menu,
		sliding: sliding
	}

	let menu_settings = {
		loginClosesMenu: false,
		cartClosesMenu: false,
		lazyLoad: lazyLoad,
		sliding: sliding,
		hasNav: true
	}

	let lightbox_settings = {
		cartAddClosesLightbox: true
	}

	errorHandler.init(error_handler_settings);
	menu.init(menu_settings);
	navigation.init(nav_settings);	
	lightbox.init(lightbox_settings);
	cart.init();
	
}