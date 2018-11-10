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

                $producto = new Producto;
                $producto->nombre = $nombre;
                $producto->precio = (float)str_replace('$', '', $precio);
                $producto->link = 'https://www.garbarino.com' . $link;
                $producto->urlImagen = $imagen;

                $listaProductos[] = $producto;
            }
            return $listaProductos;
        }

        function obtenerDetalleProducto($urlProducto)
        {
            $alto = '';
            $ancho = '';
            $profundidad = '';
            $peso = '';
            $duracionGarantia = '';
            $origenGarantia = '';
            $coberturaGarantia = '';
            $rating = '';

            $html = file_get_html($urlProducto);
            if(isset($html))
            {
                $containers = $html->find('div[class=row]');
                foreach($containers as $container)
                {
                    $columnas = $container->find('ul');
                    if(isset($columnas))
                    {
                        foreach($columnas as $columna)
                        {
                            $items = $columna->find('li');
                            foreach($items as $item)
                            {
                                $titulo = trim($item->find('span[class=gb-tech-spec-module-list-title]', 0)->innertext);
                                $valor = trim($item->find('span[class=gb-tech-spec-module-list-description]', 0)->innertext);

                                if($titulo === 'Alto') $alto = trim(str_replace('cm', '', $valor));
                                if($titulo === 'Ancho') $ancho = trim(str_replace('cm', '', $valor));
                                if($titulo === 'Ancho.') $ancho = trim(str_replace('cm', '', $valor));
                                if($titulo === 'Profundidad') $profundidad = trim(str_replace('cm', '', $valor));
                                if($titulo === 'Peso') $peso = trim(str_replace('kg', '', $valor));

                                if($titulo === 'Dimensiones')
                                {
                                    $valorSinCm = str_replace('cm', '', $valor);
                                    $valores = explode('x', $valorSinCm);
                                    if(count($valores) === 3)
                                    {
                                        $alto = trim($valores[0]);
                                        $ancho = trim($valores[1]);
                                        $profundidad = trim($valores[2]);
                                    }
                                }

                                if($titulo === 'Duración') $duracionGarantia = $valor;
                                if($titulo === 'Tiempo') $duracionGarantia = $valor;
                                if($titulo === 'Cobertura') $coberturaGarantia = $valor;
                                if($titulo === 'Origen') $origenGarantia = $valor;
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

            $detalle->alto = $alto;
            $detalle->ancho = $ancho;
            $detalle->profundidad = $profundidad;
            $detalle->peso = $peso;
            $detalle->duracionGarantia = $duracionGarantia;
            $detalle->origenGarantia = $origenGarantia;
            $detalle->coberturaGarantia = $coberturaGarantia;
            $detalle->rating = $rating;

            return $detalle;
        }
    }
?>