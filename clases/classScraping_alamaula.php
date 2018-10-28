<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'classProducto.php';

    class ScrapingAlamaula
    {
        function obtenerProductos($productoBuscado)
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
                if(count($listaProductos) == 10)
                {
                    break;
                }
                $divGeneral = $item->find('div', 0);
                $divContenedor = $divGeneral->find('div[class=container]', 0);
                $divTitulo = $divContenedor->find('div[class=title]', 0);
                $divDescripcion = $divContenedor->find('div[class=description]', 0);
                $titulo = $divTitulo->find('a', 0)->innertext;
                $divPrecio = $divContenedor->find('div[class=info]', 0);
                $spanPrecio = $divPrecio->find('span[class=amount]');
                $link = $divTitulo->find('a', 0)->href;
                $descripcion =  $divDescripcion->innertext;
                $url_img = 'https://www.alamaula.com'.$link;
                $html_img = file_get_html($url_img);
                $divImg = $html_img->find('meta[property="og:image"]', 0);
                $srcImg = $divImg->content;
                $precio = '$0';

                if(count($spanPrecio) > 0)
                {
                    $precio = (string)$spanPrecio[0];
                }

                $producto = new Producto;
                $producto->nombre = $titulo;
                $producto->precio = str_replace('$', '', $precio);
                $producto->link = 'https://www.alamaula.com' . $link;
                $producto->urlImagen = $srcImg;

                $listaProductos[] = $producto;
            }
            return $listaProductos;
        }
    }
?>