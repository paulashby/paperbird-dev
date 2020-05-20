// import { customEventPolyfill } from './helpers';
import $ from 'jquery';
import errorHandler from './utilities/errorHandler';
import menu from './modules/menu';
import navigation from './modules/navigation';
//TODO: May need to move form.js import and initialisation out of menu.js if other elements of the page include forms

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

		sliding: sliding,
		navigationClick: navigation.navigationClick,
		resetNavDropdown: navigation.resetDropdown,
		closeNavDropdown: navigation.closeDropdown

	}
	errorHandler.init(error_handler_settings);
	menu.init(menu_settings);
	navigation.init(nav_settings);	
	
}