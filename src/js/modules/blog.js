import {doAction} from '../helpers';

let setup = {
	num_posts: 2,
	success_callbacks : {
	    loadPost: function (data) {
	    	
	        $('.blog__content').append(data.markup);
	        config.blog_post = data.next_newest_id;
	        setup.num_posts = 1;
	    }
	}
};

function init () {
	let target = document.querySelector('#blog-loader');
	let options = {
 	  root: null,
 	  rootMargin: '0px',
 	  threshold: 1
 	};
	let observer = new IntersectionObserver(loadPost, options);
	observer.observe(target);
}

function loadPost () {
	if(config.blog_post) {
		
		let settings = {
		    ajaxdata: {
		        action: 'loadPost',
		        id: config.blog_post,
		        num_posts: setup.num_posts
		    },
		    callback: setup.success_callbacks.loadPost,
		    action_url: config.ajaxURL
		};
		config.blog_post = false; // Prevent same post loading twice
		doAction(settings);
	} 	
}

const blog = {
	init: init
}; 

export default blog;