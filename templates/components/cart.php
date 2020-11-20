<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");
$cart_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Cart', 'button_class'=>'menu__entrybutton menu__entrybutton--cart', 'button_type'=>'cart']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'label'=>'Continue shopping', 'action'=>'cancel']);

//TODO: The entire cart is loading with every page - better to use AJAX load if it's needed. Maybe the cart module needs an AJAX load option that initially serves up the unpopulated cart
$customCartImages = function($product) {
	
	// NOTE: These are currently the image sizes for listings
    $listing_options = [
        "sub_cat"=>true, // Just so it's defined
        "lazyImages"=>$this->modules->get("LazyResponsiveImages"),
        "product"=>$product,
        "field_name"=>"product_shot",
        "context"=>"listing", // Just so it's defined
        "desktop_hdpi"=>"200",
        "sizes"=>"(max-width: 1000px) 150px, 100px",
        "class"=>"products__product-shot",
        "lazy_load"=>true // All lazy?
    ];
    return $this->files->render('components/productListingEntry', $listing_options);
};

// Pass in customCartImages function for responsive images with lazy loading
$cart_out = $cart->renderCart(false, $customCartImages);

$out = "<h2>$cart_button</h2>
<div class='cart'>
$cart_out
$cancel_button
</div>";

return $out;