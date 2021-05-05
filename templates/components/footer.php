<?php namespace ProcessWire;
// bd($pages->get("privacy-policy"));
// $privacy_policy_url = $pages->get("privacy-policy")->url;
$now = new \DateTime('now');
$month = $now->format('M');

return "<footer class='footer'>
	<section class='footer__entry'>
		<h3 class='footer__heading'>legal</h3>
		<a class='footer__link' href='/documents/terms-conditions'>Terms &amp; Conditions</a>
		<a class='footer__link' href='/documents/privacy-policy'>Privacy Policy</a>
	</section>
	<section class='footer__entry'>
		<h3 class='footer__heading'>get in touch</h3>
		<a class='footer__link' href='/contact-us/'>Contact form</a>
		<a class='footer__link' href='/register/'>Register</a>
		<a class='footer__link' href='/request-a-catalogue/'>Request a catalogue</a>
	</section>
	<section class='footer__entry'>
		<h3 class='footer__heading'>social</h3>
		<a class='footer__link' href='//twitter.com/paperbirdpub'>Twitter</a>
		<a class='footer__link' href='//www.facebook.com/paperbirdpublishing'>Facebook</a>
		<a class='footer__link' href='http://www.pinterest.com/paperbirdpub'>Pintrest</a>
	</section>
	<section class='footer__entry'>
		<h3 class='footer__heading'>news</h3>
		<a class='footer__link' href='/sketchbook/'>Sketchbook entry</a>
		<a class='footer__link' href='/whats-on/'>What&apos;s on $month 2020</a>
	</section>
	<p class='footer__text footer__text--copyright'>&copy; 2020 Paper Bird Publishing</p>
	<p class='footer__text'>Powered by <a class='footer__text-link' href='https://processwire.com/'>Processwire</a></p>
	<p class='footer__text'>Site designed and maintained by <a class='footer__text-link' href='https://www.primitive.co/'>Primitive</a></p>
</footer>";