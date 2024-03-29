let actions = {
	updateCart: function (e) {
		let count = e.count;
		let class_suffix = count ? ' cart__counter-count--show' : '';
		$('#counter').html(e.count).attr('class', 'cart__counter-count' + class_suffix);
	}
};

function init (settings) {
	$(document).on('updateCart', function(source_event) {
		actions.updateCart(source_event);
    });
}

const cart = {
    init: init
};    

export default cart;