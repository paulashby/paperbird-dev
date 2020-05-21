<?php

$err_error = $input->post('error');
$err_stack = $input->post('stack');
$log_string = "";
$success_status = false;
$return_message = "The error could not be logged";

if($err_error) {

	$log_string .= $err_error . ": ";
	$success_status = true;
	$return_message = "The error was logged";
}
if($err_stack) {
	$log_string .= $err_stack;
	$success_status = true;
	$return_message = "The error was logged with a stack trace";
} 
if(strlen($log_string)) {
	wire("log")->save("errors", $log_string);
}

return json_encode(Array("success"=>$success_status, "message"=>$return_message));