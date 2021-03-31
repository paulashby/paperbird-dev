<?php namespace ProcessWire;

if( ! $config->ajax) {
	// We shouldn't be here...
    throw new Wire404Exception();
}

if($input->post('logout')){

	if($user->isLoggedin()) {

		$session->logout();
		return json_encode(array('success'=>true));

	}
}
$errors = array();

if( ! $input->post('email')) {
	$errors[] = "email required.";
}
if( ! $input->post('password')) {
	$errors[] = "Password required.";
}
if(count($errors)){
	return json_encode(array("success" => false, "errors" => $errors));	
}

$user_email = $sanitizer->email($input->post('email'));
$user_data = array(
	"email" => $user_email,
	"password" => $input->post('password'),
	"user" => $users->get('email=' . $this->sanitizer->selectorValue($user_email))
);
$fail_message = array("Login failed.");

if( ! $user_data['user']->id) {
	return json_encode(array("success" => false, "errors" => $fail_message));
}

$pcp = wire("modules")->get("ProcessContactPages");
$username = $user_data['user']->name;
$user = $pcp->login($username, $input->post('password'));

if(is_string($user)){
	// ProcessContactPages has returned an error string
	return json_encode(array("success" => false, "errors" => array($user)));
}
if( ! is_object($user) || ! $user->id) {
	return json_encode(array("success" => false, "errors" => $fail_message));
}
$cart = $this->modules->get("OrderCart");
$num_cart_items = $cart->getNumCartItems($user->id);

return json_encode(array("success" => true, "num_cart_items" => $num_cart_items, "message" => "Hi $username, welcome back."));
