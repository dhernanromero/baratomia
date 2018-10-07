<html>
    <head>
    </head>
    <body>
        <h1>web scraping manual</h1>
        <?php
            //ejemplo obtener todos los enlaces de un sitio manualmente
            $url = "https://www.google.com";
            $html = file_get_contents($url);

            preg_match_all('/<a href="(.*?)"/', $html, $matches);

            print_r($matches);

    
        ?>


    </body>
</html>