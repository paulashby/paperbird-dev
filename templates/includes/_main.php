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
            echo $page->renderValue($page, 'titleBlock');
        ?>

        <main data-pw-id='main'>
            <h1><a href="/">Home</a></h1>
            <h2>Level two heading<br>Hows my leading?</h2>
            <h3>Level three heading<br>How bout mine?</h3>
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
