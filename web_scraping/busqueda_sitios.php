<html>
    <head>
        <link rel="stylesheet" type="text/css" href="lib/bootstrap3.css">
        <link rel="stylesheet" type="text/css" href="busqueda_sitios.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>Búsqueda de sitios:</h1>
                    <br>
                </div>
            </div>
            <div class ="row">
                <?php

                    require_once 'web_scraping.php';

                    $webScraping = new WebScraping;
                    $busqueda;
                    $resultados;

                    if(isset($_GET['botonAlamaula']))
                    {
                        $busqueda = $_GET['busquedaAlamaula'];
                        $resultados = $webScraping->obtenerProductosAlamaula($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonFravega']))
                    {
                        $busqueda = $_GET['busquedaFravega'];
                        $resultados = $webScraping->obtenerProductosFravega($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonGarbarino']))
                    {
                        $busqueda = $_GET['busquedaGarbarino'];
                        $resultados = $webScraping->obtenerProductosGarbarino($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonMusimundo']))
                    {
                        $busqueda = $_GET['busquedaMusimundo'];
                        $resultados = $webScraping->obtenerProductosMusimundo($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonLinio']))
                    {
                        $busqueda = $_GET['busquedaLinio'];
                        $resultados = $webScraping->obtenerProductosLinio($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    function imprimirResultados($busqueda, $resultados)
                    {
                        echo "<h4>Resultado de la búsqueda '" . $busqueda . "'</h4><br></div><div class='row'>";
                        echo '<div class="col-md-1"></div>';
                        echo '<div class="col-md-10"><table class="table table-striped table-bordered"><thead><tr><th>Imagen</th><th>Artículo</th><th>Precio</th><th>Link</th></tr></thead><tbody>';

                        foreach($resultados as $resultado)
                        {
                            echo '<tr><td><img src="' . $resultado->urlImagen . '"></td><td>' . $resultado->nombre . '</td><td>' . $resultado->precio . '</td><td><a href="' . $resultado->link . '">' . $resultado->link . '</a></td></tr>';
                        }
                        echo '</tbody></table></div>';
                        echo '<div class="col-md-1></div>"';
                    }
                ?>
            </div>
        </div>
    </body>
    <script src="lib/jquery3.js"></script>
    <script src="lib/bootstrap3.js"></script>
</html>