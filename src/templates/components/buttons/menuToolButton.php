<?php namespace ProcessWire;

$action_attr = isset($action) ? $action : 'toggleTool';

return "<a href='#' class='{$button_class}' data-action='{$action_attr}' data-buttontype='{$button_type}'><span class='menu__entrybutton-label' data-action='{$action_attr}' data-buttontype='{$button_type}'>{$button_text}</span></a>";