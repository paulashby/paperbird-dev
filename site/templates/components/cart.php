<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");
$counter = "";
if($value["counter"]){
	$count = $cart->getNumCartItems();
	$class_suffix = $count ? " cart__counter-count--show" : ""; 
	$counter .= "<p class='cart__counter'><span id='counter' class='cart__counter-count$class_suffix'>$count</span></p>";
}
$cart_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Cart', 'button_class'=>'menu__entrybutton menu__entrybutton--cart', 'button_type'=>'cart']);

$cart_config = $this->modules->getConfig("OrderCart");

$cart_class = array_key_exists("f_shipping_info", $cart_config) && strlen($cart_config["f_shipping_info"]) ? "cart cart__shipping-info" : "cart";

$cart_out = $cart->renderEmptyCart("<div class='spinner'>
  <div class='cube1'></div>
  <div class='cube2'></div>
</div>");

$out = "<div>
	$counter
	$cart_button
</div>
<div class='$cart_class'>
$cart_out
</div>";

return $out;