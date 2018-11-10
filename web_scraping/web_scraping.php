<?php
    require_once 'scraping_alamaula.php';
    require_once 'scraping_fravega.php';
    require_once 'scraping_garbarino.php';
    require_once 'scraping_linio.php';
    require_once 'scraping_musimundo.php';

    class WebScraping
    {        
        function obtenerProductosAlamaula($busqueda)
        {
            $scraping = new ScrapingAlamaula;
            return $scraping->obtenerProductos($busqueda);
        }

        function obtenerProductosFravega($busqueda)
        {
            $scraping = new ScrapingFravega;
            return $scraping->obtenerProductos($busqueda);
        }

        function obtenerProductosGarbarino($busqueda)
        {
            $scraping = new ScrapingGarbarino;
            return $scraping->obtenerProductos($busqueda);
        }

        function obtenerProductosLinio($busqueda)
        {
            $scraping = new ScrapingLinio;
            return $scraping->obtenerProductos($busqueda);
        }

        function obtenerProductosMusimundo($busqueda)
        {
            $scraping = new ScrapingMusimundo;
            return $scraping->obtenerProductos($busqueda);
        }

        function obtenerDetalleProductoGarbarino($urlProducto)
        {
            $scraping = new ScrapingGarbarino;
            return $scraping->obtenerDetalleProducto($urlProducto);
        }
    }
?>