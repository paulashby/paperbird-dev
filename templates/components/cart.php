<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");
$counter = "";
if($value["counter"]){
	$count = $cart->getNumCartItems();
	$class_suffix = $count ? " cart__counter-count--show" : ""; 
	$counter .= "<p class='cart__counter'><span id='counter' class='cart__counter-count$class_suffix'>$count</span></p>";
}
$cart_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Cart', 'button_class'=>'menu__entrybutton menu__entrybutton--cart', 'button_type'=>'cart']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'label'=>'Continue shopping', 'action'=>'cancel']);

$cart_out = $cart->renderEmptyCart();

$out = "<div>
	$counter
	$cart_button
</div>
<div class='cart'>
$cart_out
$cancel_button
</div>";

return $out;