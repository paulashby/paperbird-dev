<?php namespace ProcessWire;

$now = new \DateTime('now');
$month = $now->format('M');
$year = $now->format('Y');
$settings = $pages->get('home');
$socials_head = "";
$twitter_link = "";
$facebook_link = "";
$instagram_link = "";
$etsy_link = "";

if ($settings->socials_twitter) {
	$socials_head = "<h3 class='footer__heading'>social</h3>";
	$twitter_link = "<a class='footer__link footer__link--twitter' href='//twitter.com/paperbirdpub/'>Twitter</a>";
}
if ($settings->socials_facebook) {
	$socials_head = "<h3 class='footer__heading'>social</h3>";
	$facebook_link = "<a class='footer__link footer__link--facebook' href='//www.facebook.com/paperbirdpublishing/'>Facebook</a>";
}
if ($settings->socials_insta) {
	$socials_head = "<h3 class='footer__heading'>social</h3>";
	$instagram_link = "<a class='footer__link footer__link--instagram' href='https://www.instagram.com/paperbirdpublishing/'>Instagram</a>";
}
if ($settings->socials_etsy) {
	$socials_head = "<h3 class='footer__heading'>social</h3>";
	$etsy_link = "<p>Etsy</p><p class='footer__link footer__link--etsy'>We have a small selection of cards available in our <a href='https://www.etsy.com/uk/shop/PaperBirdGallery/' style='color: white'>Etsy shop</a>.</p>";
}

return "<footer class='footer'>
	<div class='footer__content'>
		<div class='footer__sections'>
			<section class='footer__entry'>
				<h3 class='footer__heading'>legal stuff</h3>
				<a class='footer__link footer__link--tc' href='/documents/terms-conditions'>Terms &amp; Conditions</a>
				<a class='footer__link footer__link--privacy' href='/documents/privacy-policy'>Privacy Policy</a>
				<a class='footer__link footer__link--prodinfo' href='/documents/order-product-information'>Order &amp; product info</a>
			</section>
			<section class='footer__entry'>
				<h3 class='footer__heading'>news</h3>
				<a class='footer__link footer__link--notebook' href='/notebook/'>Notebook</a>
				<a class='footer__link footer__link--whatson' href='/whats-on/'>What&apos;s on $month $year</a>
			</section>
			<section class='footer__entry'>
				<h3 class='footer__heading'>get in touch</h3>
				<a class='footer__link footer__link--contact' href='/contact-us/'>Contact form</a>
				<a class='footer__link footer__link--register' href='/register/'>Register</a>
				<a class='footer__link footer__link--catalogue' href='/request-a-catalogue/'>Get a catalogue</a>
			</section>
			<section class='footer__entry'>
                <h3 class='footer__heading'><a class='footer__link footer__link--archive' href='/archive/'>archive</a></h3>
				{$socials_head}
				{$twitter_link}
				{$facebook_link}
				{$instagram_link}
				{$etsy_link}
			</section>
		</div><!-- END footer__sections -->
		<div class='footer__credits'>
			<p class='footer__text footer__text--copyright'>&copy; $year Paper Bird Publishing</p>
			<p class='footer__text footer__text--credit'>Site created by <a class='footer__text-link' href='https://www.primitive.co/'>Primitive</a></p>
		</div><!-- END footer__credits -->
	</div><!-- END footer__content -->
</footer>";