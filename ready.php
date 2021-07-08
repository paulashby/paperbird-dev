<?php

$wire->addHookAfter('InputfieldPage::getSelectablePages', function($event) {
	if($event->object->hasField == 'biography_card') {
		// Populate artist->biography_card Page Reference field
		$selector = 'template=product, artist.title=' . $event->arguments('page')->title;
		$event->return = $event->pages->find($selector);
	} else if($event->object->hasField == 'category_image_page') {
		// Populate category_sub->category_image_page Page Reference field
		$selector = 'template=product, parent=' . $event->arguments('page');
	    $event->return = $event->pages->find($selector);
	  }
});

// Restrict inclusion of admin page-list entries by role
// guest doesn't have access to page-list, superuser gets everything
$wire->addHookAfter('ProcessPageList::execute', function($event){

	if($this->config->ajax){

		if($this->user->hasRole("superuser")) return;

		$role_pages = array(
			"manager" => array(
				"home",
				"category-main",
				"category-sub",
				"product",
				"generic-page",
				"artists",
				"artist",
				"blog"
			)
		);
		$showable = array();
		$roles_array = $this->user->roles->implode(',', 'name');
		$roles_array = explode(',', $roles_array);

		foreach ($roles_array as $usr_role) {
			if(array_key_exists($usr_role, $role_pages)) {
				$showable = array_merge($showable, $role_pages[$usr_role]);
			}
		}
		$event_data = json_decode($event->return, true);

		foreach($event_data['children'] as $key => $child){

		    $curr_entry = $this->pages->get($child['id']);
		    $curr_template = $curr_entry->template; 

		    if( ! in_array($curr_template, $showable)){
		    	unset($event_data['children'][$key]);
		    }
		}
		$event_data['children'] = array_values($event_data['children']);
        $event->return = json_encode($event_data);
    }
});