function init (settings) {

	window.addEventListener('error', function (e) {

    let ajaxurl = settings.url;
    let stack = e.error ? e.error.stack : 'stack unavailable';
    let ajaxdata = {
        error: e.error,
        message: e.message,
        stack: stack
    };

    
    $.ajax({
        type: 'post', 
        url: ajaxurl,
        data: ajaxdata,
        dataType: 'json',
        success: function(data) {
        	if(data.message) {
        		console.log(e.message + ": " + data.message);	
        	}
       },
        error: function(jqXHR, textStatus, errorThrown) {
        	console.log(textStatus, errorThrown);
        } 
    });

});

}

const errorHandler = {
    init: init
};

export default errorHandler;