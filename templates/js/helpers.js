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

 export { customEventPolyfill, dataAttrClickHandler };
