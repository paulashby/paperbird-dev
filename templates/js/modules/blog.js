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
	// setting should be an object whose keys are actions names (eg 'addedToCart') and values are message strings
	// setup.messages = settings;
	// $(document).on('addedToCart', function(event) {
	// 	populateMessage(setup.messages[event.type]);
 	//    });
 	// console.log(config);
 	let options = {
 	  root: null,
 	  rootMargin: '0px',
 	  threshold: 1
 	}

 	let observer = new IntersectionObserver(loadPost, options);
 	let target = document.querySelector('#blog-loader');
	observer.observe(target);

	// window.addEventListener('popstate', function (event) {

	//     let state = event.state;

	//     if (state) {
	        
	        /*
	        Ajax load the content?
	        Why not just remove the last blog entry?

	        The load history stuff is useful for reassembling the page based on url segment
			but is really a bit crazy for simply removing the last post

			AND in fact WHY would we do this anyway??

			This is all a result of messing with pushState - probably best to forget about state and bookmarking and just load the data.

			Note, do we want to replace what's there, or get the server to reassemble the posts working back from the most recent post?
	        If we want to reassemble, could get older posts than the page in the state in php by using an 'id < ...' selector within notebook->children()
	        	        //  

	        */
// 	        loadHistoryState(state.featuredPost);
// 	    }
// 	});
// }
}
/*
	Thinking now I need two functions 
	• one to append a single post - loadPost()
	• one to load all posts as a history request - loadHistoryState()
*/

function loadPost () {
	// 
	/*
		https://stackoverflow.com/questions/38089507/how-to-change-url-after-success-in-ajax-without-page-reload
	*/

	if(config.blog_post) {
		// let options = {
		// 	id: config.blog_post,
		// 	from_history: false,
		// 	callback: setup.success_callbacks.loadPost
		// };
		// requestContent(options);
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

// function loadHistoryState (newest) {

// 	let options = {
// 		id: newest,
// 		from_history: true,
// 		callback: setup.success_callbacks.loadHistory
// 	};
// 	requestContent(options);
// }

// function requestContent (options) {
// 	console.log('requestContent');
// 	let settings = {
// 	    ajaxdata: {
// 	        action: 'loadBlogContent',
// 	        id: options.id,
// 	        from_history: options.from_history
// 	    },
// 	    callback: options.callback,
// 	    action_url: config.ajaxURL
// 	};

// 	doAction(settings);
// }

// function updateState (data) {

// 	let state = { featuredPost: config.blog_post },
// 	    title = data.page_title,
// 	    path  = "/" + config.blog_post;
	
// 	window.history.pushState(state, title, path);

// 	config.blog_post = data.next_newest;
// }

const blog = {
	init: init
}; 

export default blog;