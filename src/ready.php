<?php

// Redirect customers from back end to homepage
$this->addHookBefore('PageRender::renderPage', function($event) {

	$is_admin_page = $this->page->rootParent->id == 2;

	if($is_admin_page && $this->wire('user')->hasRole("customer")) {
		$this->wire('session')->redirect("/");
	}
});

$this->addHookBefore('OrderCart::renderCartItem', function($event) {

	$e = $event->arguments(0);
	$sku = $e["sku"];
	$product = $this->wire('pages')->get("template=product, sku=$sku");

	if( ! array_key_exists("step", $e)) {
		$cart_spec = $product->price_category->paper;
		$unit_increment = $cart_spec->unit_increment;
		$e["step"] = $unit_increment;
		$e["min"] = $unit_increment;
	}

	$product_type = $product->price_category->paper->title;

	if($product_type === 'Plumette Wallet'){
		$e["item_str"] = "wallet";
		unset($e["qty_str"]);
	}
	$event->arguments(0, $e);
});

$wire->addHookAfter('InputfieldPage::getSelectablePages', function($event) {
	if($event->object->hasField == 'biography_card') {
		// Note this field is now also used on genericPpage template for What's On and Notebook
		$curr_page = $event->arguments('page');
		$page_template = $curr_page->template->name;
		// Populate artist->biography_card Page Reference field
		$selector = $page_template == 'artist' ? 'template=product, artist.title=' . $curr_page->title : 'template=product';
		$event->return = $event->pages->find($selector);
	} else if($event->object->hasField == 'category_image_page') {
		// Populate category_sub->category_image_page Page Reference field
		$selector = 'template=product, parent=' . $event->arguments('page');
	    $event->return = $event->pages->find($selector);
	  } else if($event->object->hasField == 'duplicates') {
		// Populate category_sub->category_image_page Page Reference field
		$selector = 'template=product, parent!=' . $event->arguments('page');
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