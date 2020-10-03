/* For ie*/

function customEventPolyfill () {
	console.log('polyfill loaded');
  if ( typeof window.CustomEvent === "function" ) return false;

  function CustomEvent ( event, params ) {
  	params = params || { bubbles: false, cancelable: false, detail: null };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
   }

  window.CustomEvent = CustomEvent;

}

function dataAttrClickHandler(e, actions) {

    let action = $(e.target).data('action');

    if(actions[action]) {
        actions[action](e);
    }

}

function doAction (settings) {
  $.ajax({
    type        : 'get',
    url         : settings.action_url,
    data        : settings.ajaxdata,
    dataType    : 'json',
    encode      : true,
    cache       : true
  })        
  .done(function(response) {

    if(response.error) {
      //TODO: Handle this
      console.warn('Ajax call returned an error');
    } else {
      settings.callback(response.data);
    }
  });
}

export { customEventPolyfill, dataAttrClickHandler, doAction };
