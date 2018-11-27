<?php
	require_once 'lib/simple_html_dom.php';
    require_once 'classProducto.php';
    require_once 'classDetalleProducto.php';

	class MercadoLibreApi
	{
		function obtenerProductos($art)
		{
		   // echo "entre a la funcion";
		    $url = "https://api.mercadolibre.com/sites/MLA/search?q=".str_replace(" ", "+", $art);
		    $ProductosML = json_decode(file_get_contents($url),true);

		    $listaProductos = array();
		    for ($i=0; $i <10 ; $i++) { 
		        # code...
		        // $var = array();
		        // $var[] = $ProductosML["results"][$i]["title"];
		        // $var[] = $ProductosML["results"][$i]["permalink"];
		        // $var[] = $ProductosML["results"][$i]["thumbnail"];
		        // $var[] = (float)$ProductosML["results"][$i]["price"];
		        
		        // $listaProductos[] = $var;
		        $producto = new Producto();
		        //$producto->id = $ProductosML['results'][$i]{"id"};
		        $producto->nombre = $ProductosML["results"][$i]["title"];
		        $producto->link = $ProductosML["results"][$i]["permalink"];
		        $producto->urlImagen = $ProductosML["results"][$i]["thumbnail"];
		        $producto->precio = $ProductosML["results"][$i]["price"];
		        $producto->precio = number_format((float)$producto->precio,2,'.','');
		        $producto->codpagina = 'MLA';		        
 				// $producto->pagina = 'Mercado Libre';	
 				$producto->pagina = "img/mercadolibrelogo.jpg";
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
            	$container = $html->find('section[class=ui-view-more vip-section-specs main-section]', 0);
 				if(isset($container))
 				{
	            	$caract = $container->find('ul',0);
	            	if(isset($caract))
 					{
		            	$lista = $caract->find('li');

		            	foreach ($lista as $li) 
		            	{
		            		$car = $li->find('strong',0)->innertext;
		            		$val = $li->find('span',0)->innertext;

		            		$listado[$car] = $val; 
		            	}
		            }
            	}

            	$rating = $html->find('span[class=review-summary-average]',0);
            	if(isset($rating))
            	{
            		$rating = $rating->innertext;
            	}
            }

            $detalle = new DetalleProducto;
            $detalle->rating = $rating;
            $detalle->caracteristicas = $listado;

            return $detalle;

		}
	}
?>