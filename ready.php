<?php

// Populate artist->biography_card Page Reference field
$wire->addHookAfter('InputfieldPage::getSelectablePages', function($event) {
	if($event->object->hasField == 'biography_card') {
		$selector = 'template=product, artist.title=' . $event->arguments('page')->title;
		$event->return = $event->pages->find($selector);
  }
});
