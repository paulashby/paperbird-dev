<?php namespace ProcessWire;

$now = new \DateTime('now');
$month = $now->format('M');
$year = $now->format('Y');

return "<footer class='footer'>
	<div class='footer__content'>
		<div class='footer__sections'>
			<section class='footer__entry'>
				<h3 class='footer__heading'>legal</h3>
				<a class='footer__link' href='/documents/terms-conditions'>Terms &amp; Conditions</a>
				<a class='footer__link' href='/documents/privacy-policy'>Privacy Policy</a>
				<a class='footer__link' href='/documents/order-product-information'>Order &amp; product info</a>
			</section>
			<section class='footer__entry'>
				<h3 class='footer__heading'>news</h3>
				<a class='footer__link' href='/notebook/'>Notebook</a>
				<a class='footer__link' href='/whats-on/'>What&apos;s on $month $year</a>
			</section>
			<section class='footer__entry'>
				<h3 class='footer__heading'>get in touch</h3>
				<a class='footer__link' href='/contact-us/'>Contact form</a>
				<a class='footer__link' href='/register/'>Register</a>
				<a class='footer__link' href='/request-a-catalogue/'>Get a catalogue</a>
			</section>
			<section class='footer__entry'>
				<h3 class='footer__heading'>social</h3>
				<a class='footer__link' href='//twitter.com/paperbirdpub'>Twitter</a>
				<a class='footer__link' href='//www.facebook.com/paperbirdpublishing'>Facebook</a>
				<a class='footer__link' href='http://www.pinterest.com/paperbirdpub'>Pintrest</a>
			</section>
		</div><!-- END footer__sections -->
		<div class='footer__credits'>
			<p class='footer__text footer__text--copyright'>&copy; 2020 Paper Bird Publishing.</p>
			<p class='footer__text'>Site created by <a class='footer__text-link' href='https://www.primitive.co/'>Primitive</a>.</p>
		</div><!-- END footer__credits -->
	</div><!-- END footer__content -->
</footer>";