<?php namespace ProcessWire;

$page = $value;

echo "<div class='titleBlock'>
    <img class='titleBlock__logo' src='" . $page->logo->url . "' alt='Paperbird logo'>
    <h1 class='titleBlock__title'>Delightfully cute &amp; quirky</h1>";

    // Menu
    $menu_options = array(
        "navigation" => true,
        "search" => true,
        "login" => true,
        "basket" => true
    );
    echo $page->renderValue($menu_options, 'menu');
                
echo "</div>";