<html>
    <head>
    </head>
    <body>
        <h1>simple html dom parser</h1>
        <a href="http://simplehtmldom.sourceforge.net/">Sitio de la libreria</a>
        <p>se debería poder indexar a esta pagina las imagenes y links de google pero tira error....</P>
        <?php
            include('simple_html_dom.php');
            // Create DOM from URL or file
            $html = str_get_html('https://www.google.com.ar/');

            print_r($html);
            // Find all images 
            foreach($html->find('img') as $element) 
                echo $element->src . '<br>';

            // Find all links 
            foreach($html->find('a') as $element) 
                echo $element->href . '<br>';

        ?>

    </body>
</html>