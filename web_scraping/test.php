<?php
	require_once 'web_scraping.php';
	$url = 'https://articulo.mercadolibre.com.ar/MLA-747974283-notebook-lenovo-core-156-core-i5-ram-4gb-330s-15ikb-81f50-_JM?quantity=1#reco_item_pos=0&reco_backend=machinalis-seller-items&reco_backend_type=low_level&reco_client=vip-seller_items-above&reco_id=e5d8ca21-2cb0-4971-9992-80f575a71a26;';
	$scraping = new WebScraping;

  	$detalle = $scraping->obtenerDetalleProductoMercadoLibre($url);

    // $idProducto = 'MLA724294175';

    // $detalle2 = $scraping->obtenerDetalleProductoMercadoLibre2($idProducto);
    // foreach ($detalle2 as $det) 
    // {
    // 	echo($det);
    // }
    $rating = $detalle->rating;
    $detalles = $detalle->caracteristicas;
    echo count($detalles);

    echo '<h3>rating: ' . $rating . '</h3>';
    echo '<table border="1"><thead><tr><th>caracteristica</th><th>valor</th></tr></thead><tbody>';
    foreach($detalles as $clave=>$valor)
    {
        echo '<tr><td>' . $clave . '</td><td>' . $valor . '</td></tr>';
    }
    echo '</tbody></table>';
?>