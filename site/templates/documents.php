<?php namespace ProcessWire;

// https://processwire.com/docs/front-end/how-to-use-url-segments/
$doc_name = $input->urlSegment1;
$contact_doc = $pages->get("/internal/contact-pages/settings/documents/$doc_name");
$title = $contact_doc->title;
$doc_body = $contact_doc->ctct_document;

$revisions = $contact_doc->versionControlRevisions();
$last_edited = date("F j, Y", strtotime(reset($revisions)) );
$doc_body = str_replace("&lt;pp-date-placeholder&gt;", $last_edited, $doc_body);

$contact_page_url = $pages->get('contact-us')->url;
$doc_body = str_replace("&lt;contact-form-placeholder&gt;", "<a href = '$contact_page_url'>contact form</a>", $doc_body);


echo "<main data-pw-id='main' class='generic-page'>
	<h1 class='page-title'>$title</h1>
	<div class='contact-pages-doc'>
		$doc_body
	</div>
</main>";