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

	let nav_settings = {
	
		top_cat_class: 'nav__top-cat',
		// top_link_class: 'nav__top-link',
		top_cat_class: 'nav__top-cat',
		colorise_class: 'menu' // This requires sass classes for colours in config.scss
		
	}

	let menu_settings = {

		menu_class: 'menu',
		top_level_class: 'menu__entries',
		button_class: 'menu__button',	
		toggle_switch_class: 'menu__button--toggle',
		close_class: 'menu__button--close',
		toggle_bar_class: 'menu__bar',
		resetNavDropdown: navigation.resetDropdown

	}

	navigation.init(nav_settings);	
	menu.init(menu_settings);
}