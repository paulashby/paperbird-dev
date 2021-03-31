<?php namespace ProcessWire;

$pcp = $modules->get("ProcessContactPages");
			
$pcp_forms = array(
	array(
		"title" => "Contact us",
		"form" => "Contact Form",
		"handler" => $urls->templates . "js/processcontactpages.js"
	),
	// array(
	// 	"title" => "Register",
	// 	"form" => "Registration Form",
	// 	"handler" => $urls->templates . "js/processcontactpages.js" // including again as test
	// )
);
$forms_markup = $pcp->renderForms($pcp_forms);

echo "<main data-pw-id='main'>
$forms_markup
</main>";
?>
