<?php
    require_once 'scraping_garbarino.php';

    //archivo de pruebas
    //se imprime por pantalla los datos de detalle de un producto
    //se prueban distintos productos, para comprobar que trae resultados sin problemas
    //la url es el enlace que se obtiene a traves del web scraping de la busqueda de productos
    //probar de a una url y comentar el resto

    //$url = 'https://www.garbarino.com/producto/smart-tv-lg-55-4k-ultra-hd-55uk6550psb/aa5d42701f'; //tv 
    //$url = 'https://www.garbarino.com/producto/smart-tv-lg-43-4k-ultra-hd-43uk6300psb/8ace8386d4'; //tv
    //$url = 'https://www.garbarino.com/producto/celular-libre-motorola-moto-g6-plus-azul/88c31b115e'; //celular
    //$url = 'https://www.garbarino.com/producto/celular-libre-lg-q6-plateado/6ee7c04360'; //celular
    //$url = 'https://www.garbarino.com/producto/notebook-asus-x540ua-gq317t-intel-core-i5/a36207e90e'; //notebook
    //$url = 'https://www.garbarino.com/producto/notebook-lenovo-ideapad-320s-14ikb-80x400lear-intel-pentium/1efe958fa0'; //notebook
    //$url = 'https://www.garbarino.com/producto/tablet-next-technologies-10.1-ips-16gb-gris/449dec6a75'; //tablet
    //$url = 'https://www.garbarino.com/producto/impresora-multifuncion-epson-ecotank-l4160/3d53e00cb4'; //impresora
    $url = 'https://www.garbarino.com/producto/smart-tv-samsung-55-full-hd-un55k6500-agctc/1b252bd13d'; //tv

    $scrapingGarbarino = new ScrapingGarbarino;

    $detalle = $scrapingGarbarino->obtenerDetalleProducto($url);

    echo '<br> alto: ' . $detalle->alto;
    echo '<br> ancho: ' . $detalle->ancho;
    echo '<br>profundidad: ' . $detalle->profundidad;
    echo '<br>peso: ' . $detalle->peso;
    echo '<br>duracion garantia: ' . $detalle->duracionGarantia;
    echo '<br>origen: ' . $detalle->origenGarantia;
    echo '<br>cobertura: ' . $detalle->coberturaGarantia;
    echo '<br>rating: ' . $detalle->rating;
    
?>