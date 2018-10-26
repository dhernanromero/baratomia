<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'producto.php';

    class ScrapingFravega
    {
        function obtenerProductos($productoBuscado)
        {
            $parseProductoBuscado = str_replace(' ', '%20', $productoBuscado);
            $url = 'https://www.fravega.com/' . $parseProductoBuscado;
            $listaProductos = array();

            $html = file_get_html($url);

            $container = $html->find('div[class=shelf-resultado n3colunas]', 0);
            $ulList = $container->find('ul');

            foreach($ulList as $ulItem)
            {

                $liList = $ulItem->find('li');

                foreach($liList as $item)
                {
                    if(count($listaProductos) == 10)
                    {
                        break 2;
                    }
                    $divWrap = $item->find('div[class=wrapData]', 0);
                    if(isset($divWrap))
                    {
                        $h2 = $divWrap->find('h2', 0);
                        $a = $h2->find('a', 0);
                        $nombre = $a->innertext;
                        $precio = $item->find('div[class=wrapData]', 0)->find('span[class=prodPrice]', 0)->find('em[class=BestPrice]', 0)->innertext;
                        $imagen = $item->find('div[class=image]', 0)->find('a', 0)->find('img', 0)->src;
                        $link = $item->find('div[class=wrapData]', 0)->find('h2', 0)->find('a', 0)->href;
            
                        $producto = new Producto;
                        $producto->nombre = $nombre;
                        $producto->precio = (float)str_replace('$', '', $precio);
                        $producto->link = $link;
                        $producto->urlImagen = $imagen;
            
                        $listaProductos[] = $producto;
                    }
                }
            }
            return $listaProductos;
        }
    }
?>