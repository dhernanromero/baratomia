<html>
    <head>
    </head>
    <body>
        <?php
            require_once 'simple_html_dom.php';

            function obtenerProductosGarbarino($productoBuscado)
            {
                $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
                $url = 'https://www.garbarino.com/q/' . $parseProductoBuscado . '/srch?q=' . $parseProductoBuscado;
                $listaProductos = array();
    
                $html = file_get_html($url);
                $container = $html->find('div[class=row itemList]', 0);
    
                $lista = $container->find('div[class=itemBox]');
                
                foreach($lista as $item)
                {
                    $nombre = $item->find('h3[itemprop=name]', 0)->innertext;
                    $precio = $item->find('span[class=value-item]', 0)->innertext;
                    $imagen = $item->find('img[itemprop=image]', 0)->src;
                    $link = $item->find('a', 0)->href;

                    $producto = new Producto;
                    $producto->nombre = $nombre;
                    $producto->precio = $precio;
                    $producto->link = 'https://www.garbarino.com' . $link;
                    $producto->urlImagen = $imagen;

                    $listaProductos[] = $producto;
                }
                return $listaProductos;
            }
        ?>
    </body>
</html>