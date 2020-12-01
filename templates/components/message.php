<?php namespace ProcessWire;
// Empty message div to be populated with ajax calls
if( ! isset($message_class)) {
	$message_class = "message";
}
return "<div class='$message_class'></div>";