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
            

<!--             <h1>Delightfully cute & quirky</h1>
           <h3 class='specimen-1'>Simply beautiful contemporary greetings cards</h3> -->
            <?php 
                // Slider - selector excludes entries whose product shots are not yet set
                echo $page->renderValue($pages->find("template=artist,biography_card.product_shot>0"), "slider");
             ?>

            <p class='sample-para'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis laboriosam, id cupiditate soluta est eaque saepe doloremque tempora animi maxime sapiente magnam, laudantium nam dolores quaerat amet dicta harum enim. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam iste, aut perspiciatis provident expedita nulla molestias tempore molestiae quam alias. Cum nobis consectetur laboriosam illo voluptatem, fuga. Sunt voluptatibus, quidem.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis laboriosam, id cupiditate soluta est eaque saepe doloremque tempora animi maxime sapiente magnam, laudantium nam dolores quaerat amet dicta harum enim. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam iste, aut perspiciatis provident expedita nulla molestias tempore molestiae quam alias. Cum nobis consectetur laboriosam illo voluptatem, fuga. Sunt voluptatibus, quidem.</p>
        </main>
        <footer data-pw-id='footer'></footer>
        <region data-pw-id='scripts'>
            <?php
            echo loadWebpackChunks('js', array(
                'manifest', 'vendor', 'main'
            ));
            ?>
        </region>
    </body>
</html>
