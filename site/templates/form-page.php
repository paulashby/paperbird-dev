<?php namespace ProcessWire;

$pcp = $modules->get("ProcessContactPages");

switch ($page->name) {
	case "contact-us":
		$pcp_forms = array(
			array(
				"title" => "Contact us",
				"form" => "Contact Form",
				"handler" => $urls->templates . "js/processcontactpages.js"
			)
		);
		$forms_markup = $pcp->renderForms($pcp_forms);
		break;


	case "register":
		$pcp_forms = array(
			array(
				"title" => "Register",
				"form" => "Registration Form",
				"handler" => $urls->templates . "js/processcontactpages.js"
			)
		);
		$forms_markup = $pcp->renderForms($pcp_forms);
		break;

	
	case "request-a-catalogue":
		$pdf_url = $page->pdf->url;			
		$pcp_forms = array(
			array(
				"title" => "Get a Catalogue",
				"form" => "Catalogue Form",
				"handler" => $urls->templates . "js/processcontactpages.js",
				"pre" => "<p><a href='$pdf_url'>Download a PDF of our catalogue</a> or use the form below to order a printed copy. Please note, catalogues are for trade customers only.</p>"
			)
		);

		$forms_markup = $pcp->renderForms($pcp_forms);
		break;

	default:
		$forms_markup = "<p>Service temporarily unavailable - please try again later</p>";
		break;
}

echo "<main data-pw-id='main'>
$forms_markup
</main>";
?>
