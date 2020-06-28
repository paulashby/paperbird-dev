<?php namespace ProcessWire;

$action_attr = isset($action) ? $action : 'toggleTool';

return "<a href='#' class='{$button_class}' data-action='{$action_attr}' data-buttontype='{$button_type}'>{$button_text}</a>";