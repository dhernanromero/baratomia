<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'producto.php';

    class ScrapingMusimundo
    {
        function obtenerProductos($productoBuscado)
        {
            $parseProductoBuscado = str_replace(' ', '%20', $productoBuscado);
            $url = 'https://www.musimundo.com/Busqueda?cbrand=0&title=0&artist=0&categories=&search=' . $parseProductoBuscado . '&typeGrid=grid';
            $listaProductos = array();

            $html = file_get_html($url);
            $container = $html->find('div[class=products]', 0);

            $lista = $container->find('article[class=product]');
            
            foreach($lista as $item)
            {
                if(count($listaProductos) == 10)
                {
                    break;
                }
                $nombre = $item->find('a[class=name productClicked]', 0)->innertext;
                $precio = $item->find('span[class=price online]', 0)->innertext;
                $link = $item->find('a[class=img productClicked]', 0)->href;
                $imagen = $item->find('a[class=img productClicked]', 0)->find('img', 0)->src;

                $producto = new Producto;
                $producto->nombre = $nombre;
                $producto->precio = (float)str_replace('$', '', $precio);
                $producto->link = $link;
                $producto->urlImagen = $imagen;

                $listaProductos[] = $producto;
            }
            return $listaProductos;
        }
    }
?>