<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'producto.php';
    require_once 'detalleProducto.php';
    ini_set('display_errors',0);

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
                $precio = str_replace('$', '', $precio);
                if(strpos($precio, ',') !== false) $precio = substr($precio, 0, strpos($precio, ','));

                $producto = new Producto;
                $producto->nombre = $nombre;
                $producto->precio = $precio;
                $producto->link = 'https://www.garbarino.com' . $link;
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
                $columnas = $html->find('ul');
                if(isset($columnas))
                {
                    foreach($columnas as $columna)
                    {
                        $items = $columna->find('li');
                        foreach($items as $item)
                        {
                            $titulo = trim($item->find('span[class=gb-tech-spec-module-list-title]', 0)->innertext);
                            $valor = trim($item->find('span[class=gb-tech-spec-module-list-description]', 0)->innertext);

                            if(trim($titulo) != '')
                            {
                                if($titulo != strip_tags($titulo))
                                {
                                    $titulo = $item->find('span[class=gb-popover-title]', 0)->innertext;
                                }
                                if($valor === '')
                                {
                                    $valor = $item->innertext;
                                    if($valor != strip_tags($valor))
                                    {
                                        $valores = explode('</span>', $valor);
                                        $valor = $valores[count($valores)-1];
                                        if(trim($valor) === '')
                                        {
                                            $valor = $valores[count($valores)-2];
                                        }
                                    }
                                }
                                $listado[$titulo] = $valor;
                            }
                        }
                    }
                }

                $divRatings = $html->find('div[class=gb-product-reviews-rating]');
                if(isset($divRatings))
                {
                    foreach($divRatings as $divRating)
                    {
                        $strong = $divRating->find('strong', 0);
                        if(isset($strong))
                        {
                            $rating = $strong->innertext;
                        }
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