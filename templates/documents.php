<?php namespace ProcessWire;

// https://processwire.com/docs/front-end/how-to-use-url-segments/
$doc_name = $input->urlSegment1;
$contact_doc = $pages->get("/internal/contact-pages/settings/documents/$doc_name");
$title = $contact_doc->title;
$doc_body = $contact_doc->ctct_document;

echo "<main data-pw-id='main'>
	<h1 class='page-title'>$title</h1>
	<div class='contact-pages-doc'>
		$doc_body
	</div>
</main>";