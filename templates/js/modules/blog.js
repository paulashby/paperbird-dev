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

 	let options = {
 	  root: null,
 	  rootMargin: '0px',
 	  threshold: 1
 	}

 	let observer = new IntersectionObserver(loadPost, options);
 	let target = document.querySelector('#blog-loader');
	observer.observe(target);
}

function loadPost () {

	if(config.blog_post) {
		let settings = {
		    ajaxdata: {
		        action: 'loadPost',
		        id: config.blog_post
		    },
		    callback: setup.success_callbacks.loadPost,
		    action_url: config.ajaxURL
		};

		doAction(settings);
	} 	
}

const blog = {
	init: init
}; 

export default blog;