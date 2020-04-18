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
             echo   "<img class='logo' src='" . $page->logo->url . "' alt='Paperbird logo'>";
            // Menu
            $menu_options = array(
                "components" => array(
                    "navigation" => true,
                    "search" => true,
                    "login" => true,
                    "basket" => true
                ),
                "animated" => true
            );
            echo $page->renderValue($menu_options, 'menu');
        ?>
        <main data-pw-id='main'>
            <!-- 
                The <main> element is used to denote the content of a webpage that relates to the central topic of that page or application. It should include content that is unique to that page and should not include content that is duplicated across multiple webpages, such as headers, footers, and primary navigation elements.

                Read more: https://html.com/tags/main/#ixzz6JrK1094f

             -->
        </main>
        <?php
            echo $page->renderValue($page, 'footer');
        ?>
        <region data-pw-id='scripts'>
             <?php
             /*
                HTML region tags don't appear in final output
                WHY AM I DOING THIS THOUGH - I DON"T SEEM TO BE MANIPULATING MARKUP REGIONS IN MY OTHER TEMPLATES - SUCH AS home.php

                TRY MANIPULATING FOOTER OUTPUT IN home.php

                https://processwire.com/docs/front-end/output/markup-regions/
            */
            echo loadWebpackChunks('js', array(
                'manifest', 'vendor', 'main'
            ));
            ?>
        </region>
    </body>
</html>
