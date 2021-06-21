import {doAction} from '../helpers';

let setup = {
	success_callbacks : {
	    loadPosts: function (data) {
	    	
	        $('.blog__content').append(data.markup);
	        config.blog_post = data.next_newest_id;
	    }
	}
};

function init () {

	let options = {
 	  root: null,
 	  rootMargin: '0px',
 	  threshold: 1
 	}

 	let observer = new IntersectionObserver(loadPosts, options);
 	let target = document.querySelector('#blog-loader');
	observer.observe(target);
}

function loadPosts () {
	if(config.blog_post) {
		let settings = {
		    ajaxdata: {
		        action: 'loadPost',
		        id: config.blog_post
		    },
		    callback: setup.success_callbacks.loadPosts,
		    action_url: config.ajaxURL
		};

		doAction(settings);
	} 	
}

const blog = {
	init: init
}; 

export default blog;