<?php
	require_once 'classProducto.php';

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
		        $var = array();
		        $var[] = $ProductosML["results"][$i]["title"];
		        $var[] = $ProductosML["results"][$i]["permalink"];
		        $var[] = $ProductosML["results"][$i]["thumbnail"];
		        $var[] = (float)$ProductosML["results"][$i]["price"];
		        
		        $listaProductos[] = $var;
		        // $producto = new Producto;
		        // $producto->nombre = $ProductosML["results"][$i]["title"];
		        // $producto->link = $ProductosML["results"][$i]["permalink"];
		        // $producto->urlImagen = $ProductosML["results"][$i]["thumbnail"];
		        // $producto->precio = (float)$ProductosML["results"][$i]["price"];
		        
		        // $listaProductos[] = $producto;
		    }

		    return $listaProductos;
		}
	}
?>