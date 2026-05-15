<?php namespace ProcessWire;
/*
Render using $files->render("components/nameOfThisTemplate", $page=>$menu)
See https://processwire.com/api/ref/wire-file-tools/render/
Passing options in an array called $value allows us to use foreach to traverse and echoes the syntax of $page->renderValue()
*/
// $page = $value;

echo "<div class='titleBlock'>
    <img class='titleBlock__logo' src='" . $page->logo->url . "' alt='Paperbird logo'>
    <h1 class='titleBlock__title'>Delightfully cute &amp; quirky</h1>";

    $menu_options = array(
        "navigation" => true,
        "search" => true,
        "login" => true,
        "basket" => true
    );
    $files->include('components/menu', $menu_options);
                
echo "</div>";