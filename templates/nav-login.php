<?php

if( ! $config->ajax) {

    // We shouldn't be here...
    $session->redirect($pages->get(27)->url);

} else {
	
	$errors = Array();
	$user_data = Array();

	if($input->post('email')) {
		$user_data['email'] = $sanitizer->email($input->post('email'));
		$user_data['user'] = $users->get('email=' . $this->sanitizer->selectorValue($user_data['email']));

		if(0 === $user_data['user']->id) {
			$errors[] = 'No such user';
		}
        if( ! $input->post('password')) {
        	$errors[] = 'Password required';
        } else {
        	//TODO: Create a set of rules for password validation (not santization)length, required characters etc - same reuleset should be used on front end validation in form.js. Then validate this before storing.
        	$user_data['password'] = $input->post('password');
        	//TODO: Add password to errors if it failed validation
        }
	} else {
		$errors[] = 'email required';
	}

	if (empty($errors)) {
		$user = wire('session')->login($user_data['user'], $input->post('password'));

		if($user) {
			$data['success'] = true;
			//TODO: Could check if this is first login and adjust message accordingly - mind you, might involve greater GDPR overhead
            $data['message'] = 'Welcome back'; 
		} else {
			$data['success'] = false;
            $data['message'] = 'Login failed!';
            $data['errors'][] = 'Incorrect password';
        }   
    } else {
    	$data['success'] = false;
        $data['errors']  = $errors;
    }
}

return json_encode($data);
