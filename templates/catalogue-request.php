<?php namespace ProcessWire;

$pcp = $modules->get("ProcessContactPages");

$pdf_url = $page->pdf->url;			
$pcp_forms = array(
	array(
		"title" => "Get a Catalogue",
		"form" => "Catalogue Form",
		"handler" => $urls->templates . "js/processcontactpages.js",
		"pre" => "<p><a href='$pdf_url'>Download a PDF of our catalogue</a> or use the form below to order a printed copy</p>"
	)
);

$forms_markup = $pcp->renderForms($pcp_forms);

echo "<main data-pw-id='main'>
$forms_markup
</main>";
?>
