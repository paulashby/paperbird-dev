import {doAction} from '../helpers';

let setup = {
	next: false,
	num_items: 30,
	success_callbacks : {
	    loadArtistItems: function (data) {
	    	
	        $('.products').append(data.markup);
	        setup.lazy_load.update();
	        setup.next = data.next;
	        setup.last_loaded = data.last_loaded;
	    }
	}
};

function init (lazy_load) {
	setup.next = $('body').data('first');
	// Store reference to lazyLoad instance so we can update after loading new content
	setup.lazy_load = lazy_load;
	let target = document.querySelector('#blog-loader');
	let options = {
 	  root: null,
 	  rootMargin: '0px',
 	  threshold: 1
 	};
	let observer = new IntersectionObserver(loadArtistItems, options);
	observer.observe(target);
}

function loadArtistItems () {
	if(setup.next) {
		
		let settings = {
		    ajaxdata: {
		        action: 'loadArtistItems',
		        artist: $('body').data('artist'),
		        id: setup.next,
		        start_after: setup.last_loaded,
		        num_items: setup.num_items
		    },
		    callback: setup.success_callbacks.loadArtistItems,
		    action_url: config.ajaxURL
		};
		setup.next = false; // Prevent same post loading twice
		doAction(settings);
	} 	
}

const artist = {
	init: init
}; 

export default artist; 