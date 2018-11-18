<?php
    require_once 'web_scraping.php';

    //archivo de pruebas
    //se imprime por pantalla los datos de detalle de un producto
    //se prueban distintos productos, para comprobar que trae resultados sin problemas
    //la url es el enlace que se obtiene a traves del web scraping de la busqueda de productos
    //probar de a una url y comentar el resto

    //$url = 'https://www.linio.com.ar/p/notebook-intel-core-i5-7200u-acer-4gb-1tb-w10-pro-oferta-qdloef'; //notebook
    //$url = 'https://www.linio.com.ar/p/motorola-moto-g5-s-plus-gris-lhy47q'; //celular
    //$url = 'https://www.linio.com.ar/p/motorola-moto-e5-play-16gb-fine-gold-wxdrde'; //celular
    //$url = 'https://www.linio.com.ar/p/impresora-multifuncio-n-epson-sis-continuo-l4150-ecotank-wifi-ldrhd8'; //impresora
    //$url = 'https://www.linio.com.ar/p/monitor-acer-24-led-hd-v246hl-hdmi-vga-dvi-lezww8'; //monitor
    //$url = 'https://www.linio.com.ar/p/sandwichera-3-en-1-ultracomb-750w-sw-2801-orv56i'; //sandwichera
    //$url = 'https://www.linio.com.ar/p/notebook-lenovo-a12-9720p-quad-core-15-6-12gb-1tb-windows-10-too76o'; //notebook
    //$url = 'https://www.linio.com.ar/p/notebook-hp-envy-13-ad011la-i7-ram-8gb-360gb-ssd-2gb-geforce-940mx-windows-10-tr1xls'; //notebook
    $url = 'https://www.linio.com.ar/p/lavarropas-lg-wm8514ee6-8-5kg-carga-frontal-inverter-plata-ym27t0'; //lavarropas

    $scraping = new WebScraping;

    $detalle = $scraping->obtenerDetalleProductoLinio($url);

    $rating = $detalle->rating;
    $detalles = $detalle->caracteristicas;

    echo '<h3>rating: ' . $rating . '</h3>';
    echo '<table border="1"><thead><tr><th>caracteristica</th><th>valor</th></tr></thead><tbody>';
    foreach($detalles as $clave=>$valor)
    {
        echo '<tr><td>' . $clave . '</td><td>' . $valor . '</td></tr>';
    }
    echo '</tbody></table>';
?>