let setup = {
};

function init (settings) {
	// setting should be an object whose keys are actions names (eg 'addedToCart') and values are message strings
	setup.messages = settings;
	$(document).on('addedToCart', function(event) {
		populateMessage(setup.messages[event.type]);
    });
}

function populateMessage(mssg) {

    $('.message').html(mssg);
}

const message = {
	init: init
}; 

export default message;