<html>
    <head>
    </head>
    <body>
        <h1>simple html dom parser</h1>
        <a href="http://simplehtmldom.sourceforge.net/">Sitio de la libreria</a>
        <p>se debería poder indexar a esta pagina las imagenes y links de google pero tira error....</P>
        <?php
            // Create DOM from URL or file
            $html = file_get_html('http://www.google.com/');

            // Find all images 
            foreach($html->find('img') as $element) 
                echo $element->src . '<br>';

            // Find all links 
            foreach($html->find('a') as $element) 
                echo $element->href . '<br>';

        ?>

    </body>
</html>