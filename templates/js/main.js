// import { customEventPolyfill } from './helpers';
import $ from 'jquery';
import navigation from './modules/navigation';
import menu from './modules/menu';

window.jQuery = $;
window.$ = $;

$( document ).ready(function() {
	init();
});

function init () {

	let sliding = $('.nav').hasClass('nav--sliding');

	let nav_settings = {
		sliding: sliding
	}

	let menu_settings = {

		sliding: sliding,
		resetNavDropdown: navigation.resetDropdown,
		closeNavDropdown: navigation.closeDropdown

	}

	navigation.init(nav_settings);	
	menu.init(menu_settings);
}