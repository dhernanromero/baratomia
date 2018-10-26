<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'producto.php';

    class ScrapingLinio
    {
        function obtenerProductos($productoBuscado)
        {
            $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
            $url = 'https://www.linio.com.ar/search?q=' . $parseProductoBuscado ;
            $listaProductos = array();

            $html = file_get_html($url);
            $catalogue_item = $html->find('div[class=catalogue-product row]');

            foreach($catalogue_item as $item)
            {   
                if(count($listaProductos) == 10)
                {
                    break;
                }
                $ahref = $item->find('a',0);
                $nombre = $ahref->find('meta[itemprop=name]',0)->content;
                $image_container = $ahref->find('div[class=image-container]',0);
                $imagen =  $ahref->find('meta[itemprop=image]',0)->content;
                $source = $image_container->find('source[type=image/jpeg]',0);
                $detail_container = $ahref->find('div[class=detail-container]',0);
                $price_section = $detail_container->find('div[class=price-section]',0);
                $precio = $price_section->find('meta[itemprop=price]',0)->content;
                $link = 'https://www.linio.com.ar' . $ahref->href;

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