<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'classProducto.php';

    class ScrapingGarbarino
    {
        function obtenerProductos($productoBuscado)
        {
            $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
            $url = 'https://www.garbarino.com/q/' . $parseProductoBuscado . '/srch?q=' . $parseProductoBuscado;
            $listaProductos = array();

            $html = file_get_html($url);
            $container = $html->find('div[class=row itemList]', 0);
            $lista = $container->find('div[class=itemBox]');
            
            foreach($lista as $item)
            {
                if(count($listaProductos) == 10)
                {
                    break;
                }
                $nombre = $item->find('h3[itemprop=name]', 0)->innertext;
                $precio = $item->find('span[class=value-item]', 0)->innertext;
                $imagen = $item->find('img[itemprop=image]', 0)->src;
                $link = $item->find('a', 0)->href;

                // $producto = new Producto;
                // $producto->nombre = $nombre;
                // $producto->precio = (float)str_replace('$', '', $precio);
                // $producto->link = 'https://www.garbarino.com' . $link;
                // $producto->urlImagen = $imagen;

                // $listaProductos[] = $producto;

                $var[] = trim($nombre);
                $var[] = trim('https://www.garbarino.com' . $link);
                $var[] = trim($imagen);
                $precio_obtengo = substr(trim($precio),1);
                $precio_tranformo = str_replace(".", "", $precio_obtengo);
                $var[] = (float)$precio_tranformo;

                $listaProductos[] = $var;
            }
            return $listaProductos;
        }
    }
?>