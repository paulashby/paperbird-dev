<?php namespace ProcessWire;

if( ! isset($label)) $label = $action;

return "<input type='$button_type' class='$button_class' value='$label' data-action='$action'>";