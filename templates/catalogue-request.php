<?php namespace ProcessWire;

$pcp = $modules->get("ProcessContactPages");
			
$pcp_forms = array(
	array(
		"title" => "Request a Catalogue",
		"form" => "Catalogue Form",
		"handler" => $urls->templates . "js/processcontactpages.js"
	)
);
$forms_markup = $pcp->renderForms($pcp_forms);

echo "<main data-pw-id='main'>
$forms_markup
</main>";
?>
