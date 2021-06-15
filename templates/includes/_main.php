<?php namespace ProcessWire;

if($config->ajax) return;

// Determine current page tag for nav highlighting
$template_name = $page->template->name;
$body_nav_class = $template_name == "category-sub" ? $page->parent->name : $page->name;

/* cart-viewable is checked after a user logs in, allowing us to defer the appearance of the cart menu tool
 * and avoid a slight visual 'bump' as the other menu tools reposition to accommodate it.
 * First the logged-in class is added - this allows us to track the correct (closing) animation on the login menu tool.
 * The cart will only be shown if body element has this class, so it needs to be in place on page load for logged in users.
 */
$body_tag = $user->isLoggedin() ? "<body class='$body_nav_class logged-in cart-viewable'>" : "<body class='$body_nav_class'>";
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

        // if this is the Notebook page, get the id of the latest notepad entry
        if($template_name == "blog") {
            $newest_post_id = $page->children()->last()->id;
            
            if($newest_post_id) {
                $jsconfig["blog_post"] = $newest_post_id;
            }
        }
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