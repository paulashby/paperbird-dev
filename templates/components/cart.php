<?php namespace ProcessWire;

$cart = $this->modules->get("OrderCart");
$cart_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Cart', 'button_class'=>'menu__entrybutton menu__entrybutton--cart', 'button_type'=>'cart']);
$cancel_button = $files->render('components/buttons/formButton', ['button_class'=>'form__button form__button--cancel', 'button_type'=>'button', 'label'=>'Continue shopping', 'action'=>'cancel']);
$cart_out = $cart->renderCart();
$out = "<h2>$cart_button</h2>
<div class='cart'>
$cart_out
$cancel_button
</div>";

return $out;