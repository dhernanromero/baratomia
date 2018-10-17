<html>
    <head>
    </head>
    <body>
        <?php
            require_once 'simple_html_dom.php';

            function obtenerProductosLinio($productoBuscado)
            {
                $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);  // utiliza + para separar palabras
                $url = 'https://www.linio.com.ar/search?q=' . $parseProductoBuscado ;  // url de la pagina en busqueda . concatenacion
                $listaProductos = array();

                $html = file_get_html($url); // trae el archivo plano del html
                // $catalogue_product = $html->find('div[class=catalogue-product-sm-container switchable-product-container row]'); 
                $catalogue_item = $html->find('div[class=catalogue-product row]');

                foreach($catalogue_item as $item) // buscar las direcciones de los elementos
                {
                    
                    $ahref = $item->find('a',0);
                    $nombre = $ahref->find('meta[itemprop=name]',0)->content;
                    $image_container = $ahref->find('div[class=image-container]',0);//llama a la clase padre
                    $imagen =  $image_container->find('img',0);
                    $source = $image_container->find('source[type=image/jpeg]',0);
                    $detail_container = $ahref->find('div[class=detail-container]',0); //llama a la clase padre
                    $price_section = $detail_container->find('div[class=price-section]',0);
                    $precio = $price_section->find('meta[itemprop=price]',0)->content;
                    $link=  'https://www.linio.com.ar' . $ahref->href;

                    $producto = new Producto; //guardo los elementos en objetos
                    $producto->nombre = $nombre;
                    $producto->precio= $precio;
                    $producto->link= $link;
                    $producto->urlImagen = $imagen;

                    $listaProductos[] = $producto; // lista guarda los elementos producto

                }
                return $listaProductos;

            }
        ?>
    </body>
</html>