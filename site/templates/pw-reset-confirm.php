<?php namespace ProcessWire;

wire('session')->pwreset = false;

echo "<main data-pw-id='main'>
<h1 class='page-title'>Success</h1>
		<p class='pw-reset-confirmation'>Your password has been updated and you can now log in with your new credentials.<p>
</main>";
?>