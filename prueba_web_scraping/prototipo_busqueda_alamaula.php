<html>
    <head>
    </head>
    <body>
        <?php
            require_once 'simple_html_dom.php';

            function obtenerProductosAlamaula($productoBuscado)
            {
                $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
                $url = 'https://www.alamaula.com/s-' . $parseProductoBuscado . '/v1q0p1';
                $listaProductos = array();
    
                $html = file_get_html($url);
                $container = $html->find('div[class=view]', 0);
                if($container->class == 'view top-listings')
                {
                    $container = $html->find('div[class=view]', 1);
                }
    
                $lista = $container->find('ul', 0);
                $items = $lista->find('li');
                
                foreach($items as $item)
                {
                    $divGeneral = $item->find('div', 0);
                    $divContenedor = $divGeneral->find('div[class=container]', 0);
                    $divThumb = $divGeneral->find('div[class=thumb shrtHght]', 0);
                    $divImg = $divThumb->find('div[id=img-cnt]', 0);
                    $img = $divImg->find('img', 0);
                    $srcImg = $img->src;
                    $divTitulo = $divContenedor->find('div[class=title]', 0);
                    $divDescripcion = $divContenedor->find('div[class=description]', 0);
                    $titulo = $divTitulo->find('a', 0)->innertext;
                    $divPrecio = $divContenedor->find('div[class=info]', 0);
                    $precio = $divPrecio->find('span[class=amount]');
                    $link = $divTitulo->find('a', 0)->href;
                    $descripcion =  $divDescripcion->innertext;

                    if(count($precio) == 0)
                    {
                        $precio = array('$0');
                    }

                    $producto = new Producto;
                    $producto->nombre = $titulo;
                    $producto->precio = $precio[0];
                    $producto->link = 'https://www.alamaula.com' . $link;
                    $producto->urlImagen = $srcImg;

                    $listaProductos[] = $producto;
                }
                return $listaProductos;
            }
        ?>
    </body>
</html>