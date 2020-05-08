<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='content-type' content='text/html; charset=utf-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1' />
        <title data-pw-id='title'>Welcome to PaperBird</title>

        <?=loadWebpackChunk('css','main')?>
        <region data-pw-id='head'></region>
    </head>
    <body>
        <?php
             echo   "<img class='logo' src='" . $pages->get(1)->logo->url . "' alt='Paperbird logo'>";
            // Menu
            $menu_options = array(
                "components" => array(
                    //  - use associative entries to include options
                    "navigation" => array(
                        "tree_options" => array (
                            "parent_class" => "parent",
                            "levels" => true,
                            "levels_prefix" => "nav__level-",
                            "max_levels" => 2,
                            "outer_tpl" => "<ul class='nav__top-level'>||</ul>",
                            "inner_tpl" => "<ul class='nav__dropdown'>||</ul>",
                        ), 
                        "sliding" => false // Sliding dropdowns
                    ),
                    "login",
                    "basket",
                    "search"
                ),
                "animate_menu_button" => true
            );
           echo $page->renderValue($menu_options, 'menu');
        ?>
        <main data-pw-id='main'>
        </main>
        <?php
            echo $page->renderValue($page, 'footer');
        ?>
        <region data-pw-id='scripts'>
             <?php
             echo loadWebpackChunks('js', array(
                'manifest', 'vendor', 'main'
            ));
            ?>
        </region>
    </body>
</html>
