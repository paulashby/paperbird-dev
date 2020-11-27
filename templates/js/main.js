// import { customEventPolyfill } from './helpers';
import $ from 'jquery';
import errorHandler from './utilities/errorHandler';
import menu from './modules/menu';
import navigation from './modules/navigation';
import lightbox from './modules/lightbox';
import LazyLoad from './vendor/lazyload.esm';
//TODO: May need to move form.js import and initialisation out of menu.js if other elements of the page include forms

let lazyLoad = new LazyLoad({
  elements_selector: ".lazy",
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
		lazyLoad: lazyLoad,
		sliding: sliding,
		hasNav: true
	}
	errorHandler.init(error_handler_settings);
	menu.init(menu_settings);
	navigation.init(nav_settings);	
	lightbox.init();
	
}