<?php
    require_once 'web_scraping.php';

    //archivo de pruebas
    //se imprime por pantalla los datos de detalle de un producto
    //se prueban distintos productos, para comprobar que trae resultados sin problemas
    //la url es el enlace que se obtiene a traves del web scraping de la busqueda de productos
    //probar de a una url y comentar el resto

    //$url = 'https://www.musimundo.com/1570~audio-tv-y-video/1589~televisores/1992~smart-tv/producto~127592~C172898-E134356-televisor--43---smart-tv--43lj5500;'; //tv
    //$url = 'https://www.musimundo.com/1661~electrohogar/1676~heladeras/1680~con-freezer/producto~116644~C169175-E130593-heladera-con-freezer-hgf387awblanco;'; //heladera
    //$url = 'https://www.musimundo.com/4686~promociones/6178~ofertas-celulares-4g/producto~129745~C173995-E0-celular-libre--galaxy-j2-prime-16-gb-negro-sm-g532m;'; //celular
    //$url = 'https://www.musimundo.com/1625~informatica/1629~computadoras/1633~notebook/producto~129795~C173761-E0-notebook--ip-320-15isk;'; //notebook
    $url = 'https://www.musimundo.com/1551~clima/1552~aire-acondicionado/1554~split/producto~123952~C171975-E133236-split--553vfh0921f-2250fgh-no-kkch;'; //aire split

    $scraping = new WebScraping;

    $detalle = $scraping->obtenerDetalleProductoMusimundo($url);

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