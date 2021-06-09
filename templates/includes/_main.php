<?php namespace ProcessWire;

if($config->ajax) return;

// Determine current page tag for nav highlighting
$template_name = $page->template->name;
$body_nav_class = $template_name == "category-sub" ? $page->parent->name : $page->name;

$body_tag = $user->isLoggedin() ? "<body class='$body_nav_class logged-in'>" : "<body class='$body_nav_class'>";
$title = $page->title === "Home" ? "Welcome to Paper Bird" : $page->title;
$menu = "";
$footer = "";

if($template_name != "maintenance") {

    if($pages->get('template=home')->offline) {
        $session->redirect($pages->get('template=maintenance')->url);
    }

    $menu_options = array(
        "components" => array(
             //  - use associative entries to include options
            "navigation" => array(
                "tree_options" => array(
                    "parent_class" => "parent",
                    "levels" => true,
                    "levels_prefix" => "nav__level-",
                    "max_levels" => 2,
                    "selector" => "template!=section",
                    "outer_tpl" => "<ul class='nav__top-level'>||</ul>",
                    "inner_tpl" => "<ul class='nav__dropdown nav__dropdown--{name}' data-cat='{name}'>||</ul>",
                ), 
                "sliding" => false // Sliding dropdowns
            ),
            "login",
            "cart" => array(
                "counter" => true),
            "search" => array(
                "container" => true
            )
        ),
        "animate_menu_button" => true
    );

    $menu = $files->render("components/menu", $menu_options);
    $footer = $files->render("components/footer"); 
}

echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title data-pw-id='title'>$title</title>";
        // Data for javascript
        $jsconfig = include $config->paths->templates . "utilities-urls.php";
        $settings = $pages->get("/tools/settings/");

        echo "<script>var config = " . json_encode($jsconfig) . ";</script>";
        echo loadWebpackChunk('css','main');
        echo "<region data-pw-id='head'></region>
    </head>
    $body_tag
        <div class='content'>
             <a href=" . $config->urls->root . " class='home-link'><img class='logo' src='" . $pages->get(1)->logo->url . "' alt='Paperbird logo'></a>
             $menu";

             $chunks = loadWebpackChunks('js', array(
                'manifest', 'vendor', 'main'
            ));

           echo "<main data-pw-id='main'>
                </main>
            </div><!-- END content -->
            $footer
            <region data-pw-id='scripts'>
                $chunks
            </region>
                </body>
            </html>";