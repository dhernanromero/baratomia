<html>
    <head>
    </head>
    <body>
        <h1>simple html dom</h1>
        <?php

        // Create DOM from URL or file
        require 'simple_html_dom.php';
        $html = file_get_html('https://www.google.com/');

        // Find all images 
        //foreach($html->find('img') as $element) 
        //    echo $element->src . '<br>';

        // Find all links 
        foreach($html->find('a') as $element) 
            echo $element->href . '<br>';

    
        ?>


    </body>
</html>