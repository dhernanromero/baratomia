<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'classProducto.php';
    require_once 'classDetalleProducto.php';


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
                if(strpos($precio, ',') !== false) $precio = substr($precio, 0, strpos($precio, ','));

                $producto = new Producto;
                $producto->nombre = $nombre;
                $producto->precio = str_replace('$', '', $precio);
                $producto->link = $link;
                $producto->urlImagen = $imagen;

                $listaProductos[] = $producto;
            }
            return $listaProductos;
        }

         function obtenerDetalleProducto($urlProducto)
        {
            $html = file_get_html($urlProducto);
            $rating = '';
            $listado = array();

            if(isset($html))
            {
                $container = $html->find('div[class=features-box-section col-xs-12 col-md-6 col-lg-4]', 0);
                if(isset($container))
                {
                    $filas = $container->find('tr');
                    if(isset($filas))
                    {
                        foreach($filas as $fila)
                        {
                            $clave = $fila->find('td', 0)->innertext;
                            $valor = $fila->find('td', 1)->innertext;
                            $listado[$clave] = $valor;
                        }
                    }
                }

                $divRating = $html->find('div[class=chart]', 0);
                if(isset($divRating))
                {
                    $filasRating = $divRating->find('div[class=chart-progress]');
                    if(isset($filasRating))
                    {
                        $rating = 0;
                        $stars = 5;
                        $cantVotos = 0;
                        foreach($filasRating as $fila)
                        {
                            $dato = $fila->find('span', 2)->innertext;
                            $rating = $rating + ($stars * $dato);
                            if($dato != 0) $cantVotos = $cantVotos + $dato;
                            $stars = $stars - 1;
                        }
                        $rating = round($rating / $cantVotos, 2);
                    }
                }
            }

            $detalle = new DetalleProducto;
            $detalle->rating = $rating;
            $detalle->caracteristicas = $listado;

            return $detalle;
        }
    }
?>