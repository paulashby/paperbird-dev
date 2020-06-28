<?php namespace ProcessWire;

$basket_button = $files->render('components/buttons/menuToolButton', ['button_text'=>'Basket', 'button_class'=>'menu__entrybutton menu__entrybutton--basket', 'button_type'=>'basket']);

$out = "<h2>{$basket_button}</h2>
<ul class='basket'><li>Basket here</li></ul>";

return $out;

