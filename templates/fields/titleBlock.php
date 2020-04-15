<?php
$page = $value;

echo "<div class='titleBlock'>
    <img class='titleBlock__logo' src='" . $page->logo->url . "' alt='Paperbird logo'>
    <h1 class='titleBlock__title'>Delightfully cute &amp; quirky</h1>";


    // Menu
    // Booleans currently not doing any thing - just providing first argument - might come in handy if we have options though
    $menu_options = array(
        "navigation" => array(
            "parent_class" => "parent",
            "levels" => true,
            "levels_prefix" => "nav__level-",
            "max_levels" => 2,
            "outer_tpl" => "<ul class='nav__top-level'>||</ul>",
            "inner_tpl" => "<ul class='nav__dropdown'>||</ul>",
            // template string for the items. || will contain entries, %s will replaced with class="..." string

            // 'list_field_class' => '{title}', // string (default '') add custom classes to each list_tpl using tags like {field} i.e. {template} p_{id}

        ),
        "search" => true,
        "login" => true,
        "basket" => true
    );

// $log->save('primitive-log', $page->renderValue($menu_options, 'menu'));
    echo $page->renderValue($menu_options, 'menu');
                
echo "</div>";