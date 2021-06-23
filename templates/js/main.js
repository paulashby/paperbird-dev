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

	if($('body').hasClass('notebook')) {	
		blog.init();
	} else if($('body').hasClass('artist')){
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