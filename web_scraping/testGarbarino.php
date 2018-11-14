<?php
    require_once 'web_scraping.php';

    //archivo de pruebas
    //se imprime por pantalla los datos de detalle de un producto
    //se prueban distintos productos, para comprobar que trae resultados sin problemas
    //la url es el enlace que se obtiene a traves del web scraping de la busqueda de productos
    //probar de a una url y comentar el resto

    //$url = 'https://www.garbarino.com/producto/smart-tv-lg-55-4k-ultra-hd-55uk6550psb/aa5d42701f'; //tv
    //$url = 'https://www.garbarino.com/producto/smart-tv-lg-43-4k-ultra-hd-43uk6300psb/8ace8386d4'; //tv
    $url = 'https://www.garbarino.com/producto/celular-libre-motorola-moto-g6-plus-azul/88c31b115e'; //celular
    //$url = 'https://www.garbarino.com/producto/celular-libre-samsung-j2-prime-negro/d74d0cabf7'; //celular
    //$url = 'https://www.garbarino.com/producto/notebook-asus-x540ua-gq317t-intel-core-i5/a36207e90e'; //notebook
    //$url = 'https://www.garbarino.com/producto/notebook-lenovo-ideapad-320s-14ikb-80x400lear-intel-pentium/1efe958fa0'; //notebook
    //$url = 'https://www.garbarino.com/producto/tablet-next-technologies-10.1-ips-16gb-gris/449dec6a75'; //tablet
    //$url = 'https://www.garbarino.com/producto/impresora-multifuncion-epson-ecotank-l4160/3d53e00cb4'; //impresora
    //$url = 'https://www.garbarino.com/producto/smart-tv-samsung-55-full-hd-un55k6500-agctc/1b252bd13d'; //tv
    //$url = 'https://www.garbarino.com/producto/all-in-one-hp-20-c218la-intel-celeron/c62f0fe2b6'; //all in one
    //$url = 'https://www.garbarino.com/producto/tablet-exo-wave-i101g-10.1-mediatek-blanco-16-gb/7471006be0'; //tablet
    //$url = 'https://www.garbarino.com/producto/minicomponente-lg-cj98/d4f4ac4858'; //equipo de musica
    //$url = 'https://www.garbarino.com/producto/lavarropas-automatico-drean-6-kg-next-6.08-eco-blanco/8be63eeca5'; //lavarropas
    //$url = 'https://www.garbarino.com/producto/heladera-frio-combinado-kohinoor-kdan-41947-acero-inoxidabl/c2d133dce4'; //heladera
    //$url = 'https://www.garbarino.com/producto/colchon-y-sommier-lexington-gris-king-size-200-x-180-cms/d721e30a24'; //colchon carito

    $scraping = new WebScraping;

    $detalle = $scraping->obtenerDetalleProductoGarbarino($url);

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