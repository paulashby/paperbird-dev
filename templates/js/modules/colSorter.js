import {doAction} from '../helpers';

let setup = {
	success_callbacks : {
	    loadPost: function (data) {
	    	$('.blog-content').append(data.markup);
	        config.blog_post = data.next_newest_id;
	    }
	}
};

function init (settings) {

	setup.sort_point = settings.sort_point

	$(window).on('resize orientationchange', (function(){
	
		let resize_timeout;
		
		return function () {
			
			clearTimeout(resize_timeout);

			resize_timeout = setTimeout(function(){
			    $(window).trigger('resized');
			}, 250);
		}
	    
	})());
	$(window).on('resized', (function(){

		let prev = $(window).width();
		let sortEntries = (function(){

			return function (entries, narrow) {

				if(narrow) { 
					return sortNarrow(entries); 
				}
				return sortWide(entries);
			}

		})();

        return function () {
        	let curr = $(window).width();
        	let was_narrow = prev < settings.sort_point;
        	let is_narrow = curr < settings.sort_point;

        	if(was_narrow !== is_narrow) {
        		// New width requires a resort, Pass entries to appropriate sorting function
        		// let entries = sort[is_narrow ? 'narrow' : 'wide']($('.event-entry'));
        		let entries = sortEntries($('.event-entry'), is_narrow);
        		$('.gp__content').html(entries);
        	}
        	// Set value of prev in containing scope
        	prev = curr;
        }    
	})());

	if($(window).width() >= setup.sort_point) {
		let entries = sortWide($('.event-entry'));
		$('.gp__content').html(entries);
	}
}
function sortNarrow (entries) {

	// Return posts to original order
	let length = entries.length;
	let col_length = Math.ceil(length/2);
	let desorted = [];

	$.each(entries, function( i, item ) {
	 	if(i < col_length){
	 	    desorted[2 * i] = item;
	 	} else {
	 	    let l = length - (1 - length % 2); // length - 1 if even
	        desorted[i + (i - l)] = item;
	 	}
	});
	return desorted;
}
function sortWide (entries) {

	// Sort posts to read l to r in a two column layout 
	// (odd entries at bottom get pushed into column 2)
	let sorted = [];
	$.each(entries, function( i, item ) {
	 	if(i % 2){
	 	    sorted.push(item);
	 	} else {
	 	    sorted.splice(i - i * 0.5, 0, item);
	 	}
	});
	return sorted;
}


const whatson = {
	init: init
}; 

export default whatson;