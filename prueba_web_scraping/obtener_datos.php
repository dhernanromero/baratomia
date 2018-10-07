<html>
    <head>
    </head>
    <body>
        <h1>Categorias de alamaula:</h1>
        <br>
        <?php
            require 'simple_html_dom.php';

            $html = file_get_html('https://www.alamaula.com/');
            $divOuter = $html->find('div[class=outer]', 0);
            $links = $divOuter->find('a');

            foreach($links as $link)
            {
                echo $link->innertext;
            }

            /*
            //ejemplo para olx (no funciona por timeout, posible sitio anti scraping)
            $html = file_get_html('https://www.olx.com.ar/');
            $list = $html->find('ul[class=categories]', 0);

            foreach($list as $l)
            {
                $li = $list->find('li');
                $div = $li->find('div');
                $h2 = $div->find('h2');
                $a = $h2->find('a');
                echo $a->innertext . '<br>';
            }
            */
    
        ?>


    </body>
</html>