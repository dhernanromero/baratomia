<?php
    require_once 'lib/simple_html_dom.php';
    require_once 'classProducto.php';
    require_once 'classDetalleProducto.php';

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
                $container = $html->find('div[id=divCardData]', 0);
                if(isset($container))
                {
                    $filas = $container->find('tr');
                    if(isset($filas))
                    {
                        foreach($filas as $fila)
                        {
                            $clave = $fila->find('td[class=name]', 0)->innertext;
                            $valor = $fila->find('td[class=desc upperCase]', 0)->innertext;
                            if($valor != '-')
                            {
                                $listado[$clave] = $valor;
                            }
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