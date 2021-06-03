<?php namespace ProcessWire;

$out = "";
$base = wire("config")->urls;
$cssUrl = $base->InputfieldPassword."InputfieldPassword.css";
$out .= "<link rel='stylesheet' href='$cssUrl'>";

$jsUrls = array();
$jsUrls[] = $base->JqueryCore."JqueryCore.js";
$jsUrls[] = $base->InputfieldPassword."complexify/jquery.complexify.min.js";
$jsUrls[] = $base->InputfieldPassword."complexify/jquery.complexify.banlist.js";
$jsUrls[] = $base->JqueryCore."xregexp.min.js";
$jsUrls[] = $base->InputfieldPassword."InputfieldPassword.js";

foreach ($jsUrls as $jsUrl) {
	$out .= "<script src='$jsUrl'></script>";
}

$process = $this->modules->get("ProcessForgotPassword");
/** @var ProcessForgotPassword $process */
$out .= $process->execute();

echo "<main data-pw-id='main'>{$out}</main>";