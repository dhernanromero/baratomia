<?php
    require_once 'web_scraping.php';

    //archivo de pruebas
    //se imprime por pantalla los datos de detalle de un producto
    //se prueban distintos productos, para comprobar que trae resultados sin problemas
    //la url es el enlace que se obtiene a traves del web scraping de la busqueda de productos
    //probar de a una url y comentar el resto

    //$url = 'https://www.fravega.com/netflix-tv-4k-49--toshiba-u4700-501842/p'; //tv
    //$url = 'https://www.fravega.com/celular-libre-lg-q6-alpha-m700ar-black-781008/p'; //celular
    //$url = 'https://www.fravega.com/heladera-ciclica-philco-phcc340x-340lt-160431/p'; //heladera
    //$url = 'https://www.fravega.com/aire-acondicionado-split-inverter-frio-calor-bgh-bsih23cp-2300f-2650w-20452/p'; //aire acondicionado
    //$url = 'https://www.fravega.com/sommier-y-colchon-de-resortes-springwall-mcb-115-160-x-200-cm-610175/p'; //sommier
    //$url = 'https://www.fravega.com/luminaria-de-pared-philips-mendel-x-2l-670101/p'; //lampara
    $url = 'https://www.fravega.com/notebook-lenovo-14--core-i7-ram-4gb-ideapad-320-14ikb-80xk0130-363343/p'; //notebook

    $scraping = new WebScraping;

    $detalle = $scraping->obtenerDetalleProductoFravega($url);

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