<?php namespace ProcessWire;

if($config->ajax) return;

/* 
 * cart-viewable is checked after a user logs in, allowing us to defer the appearance of the cart menu tool
 * and avoid a slight visual 'bump' as the other menu tools reposition to accommodate it.
 * First the logged-in class is added - this allows us to track the correct (closing) animation on the login menu tool.
 * The cart will only be shown if body element has this class, so it needs to be in place on page load for logged in users.
 */



// Data for javascript
$jsconfig = include $config->paths->templates . "utilities-urls.php";

$settings = $pages->get("/tools/settings/");

$template_name = $page->template->name;

// if this is the Notebook page, get the id of the latest notepad entry
if($template_name == "blog") {
    $newest_post_id = $page->children()->last()->id;
    
    if($newest_post_id) {
        $jsconfig["blog_post"] = $newest_post_id;
    }
}

if($template_name == "category-sub"){
    $body_nav_class = $page->parent->name . " " . $page->name; 
} else if($template_name == "artist"){
     $body_nav_class = "artist"; 
} else {
    $body_nav_class = $page->name;
}


if($template_name == "artist"){
    $artist_attr = $page->name;
    $first_product_attr = $pages->find("template=product, artist.title=$artist_name")->first()->id;
    $body_data_attr = "data-artist='$artist_attr' data-first='$first_product_attr'";   
} else {
    $body_data_attr = "";
}

if($user->isLoggedin()) {
    $body_tag = "<body class='$body_nav_class logged-in cart-viewable no-touch' $body_data_attr>";    
} else {
    $body_tag = "<body class='$body_nav_class no-touch' $body_data_attr>";   
}

if($page->title == "Home") {
    $title = "Welcome to Paper Bird";   
} else {
    $title = $page->title;
}

$menu = "";
$footer = "";

if($template_name != "maintenance") {

    if($pages->get('template=home')->offline) {

        $permitted = $user->hasRole("superuser") || $user->hasRole("manager");

        if( ! $permitted){
            $session->redirect($pages->get('template=maintenance')->url);
        }
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
                "sliding" => false, // Sliding dropdowns
            ),
            "scrim", // Add overlay while any of following menu items are active
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
    $company_logo_url = $pages->get(1)->logo->url;
} else {
    $company_logo_url = "/site/templates/img/paperbirdLogo_w.svg";
}
    $template_path = $config->urls->templates;
    $js_url = $template_path . glob("js/main.min.*.js")[0];
    $css_url = $template_path . glob("css/main.min.*.css")[0];

echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title data-pw-id='title'>$title</title>
        <script>var config = " . json_encode($jsconfig) . ";</script>";

        echo "<link rel='stylesheet' type='text/css' href='$css_url' />";

        echo "<region data-pw-id='head'></region>
    </head>
    $body_tag
        <div class='content'>
             <a href=" . $config->urls->root . " class='home-link'><img class='logo' src='$company_logo_url' alt='Paperbird logo'></a>
             $menu";
             echo "<main data-pw-id='main'>
                </main>
            </div><!-- END content -->
            $footer
            <region data-pw-id='scripts'>
                <script src='$js_url'></script>
            </region>
                </body>
            </html>";