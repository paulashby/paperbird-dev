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