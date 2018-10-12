<html>
    <head>
    <style>
        .thumbM {
            width : 100%;
            max-width: 150px;
        }
    </style>
    </head>
    <body>
        <h1>Prueba de búsqueda de alamaula:</h1>
        <br>
        <?php
            /*Deshabilito la publicacion de errores*/
            error_reporting(0);

            require 'simple_html_dom.php';

            $busqueda = $_GET['busqueda'];
            
            echo "<h3>Resultado de la búsqueda '" . $busqueda . "'</h3><br>";
            $parseBusqueda = str_replace(' ', '+', $busqueda);
            $url = 'https://www.alamaula.com/s-' . $parseBusqueda . '/v1q0p1';

            $html = file_get_html($url);
			
            $container = $html->find('div[class=view]', 0);
            if($container->class == 'view top-listings')
            {
                $container = $html->find('div[class=view]', 1);
            }

            $lista = $container->find('ul', 0);
            $items = $lista->find('li');

            echo '<table><tr><th>Imagen</th><th>Articulo</th><th>Descripcion</th></tr>';
            foreach($items as $item)
            {
                $divGeneral = $item->find('div', 0);
                $divContenedor = $divGeneral->find('div[class=container]', 0);
                //$divThumb = $divGeneral->find('div[class=thumb shrtHght]', 0);
                //$divImg = $divThumb->find('div[id=img-cnt]', 0);
                //$img = $divImg->find('img', 0);
                //$srcImg = $img->src;
                $divTitulo = $divContenedor->find('div[class=title]', 0);
                $divDescripcion = $divContenedor->find('div[class=description]', 0);
				$divInfo = $divContenedor->find('span[class=amount]',0);
                $precio = $divInfo->innertext;


                $divlink = $divContenedor->find('div[class=title]', 0);
                $prelink = $divlink->find('a', 0);
                $link = $prelink->href;

                /********* Obtengo la thumbails  **********/
                /*** Busco la imagen por el META de Face de la pagina detalle */
                /*<meta property="og:image" content='https://i.ebayimg.com/00/s/ODAwWDYwMA==/z/XAkAAOSwGgdbvecx/$_20.JPG'/>*/
                $url_img = 'https://www.alamaula.com'.$link;
                $html_img = file_get_html($url_img);
                $divImg = $html_img->find('meta[property="og:image"]', 0);
                $srcImg = $divImg->content;
                
                $titulo = $divTitulo->find('a', 0)->innertext;
                $descripcion =  $divDescripcion->innertext;
                echo '<tr><td><img src="' . $srcImg . '" class="thumbM"></td><td>' . $titulo . $precio . '</td><td>' . $descripcion . '</td><td><a href='.$url_img.'>'.$link.'</a></td></tr>';
            }
        ?>
    </body>
</html>