<html>
    <head>
        <link rel="stylesheet" type="text/css" href="lib/bootstrap3.css">
        <link rel="stylesheet" type="text/css" href="prototipo_busqueda_sitios.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>Prototipo de búsqueda de sitios:</h1>
                    <br>
                </div>
            </div>
            <div class ="row">
                <?php
                    require 'prototipo_busqueda_alamaula.php';
                    require 'prototipo_busqueda_fravega.php';
                    require 'prototipo_busqueda_garbarino.php';
                    require 'prototipo_busqueda_musimundo.php';
                    require 'prototipo_busqueda_linio.php';

                    $busqueda;
                    $resultados;

                    if(isset($_GET['botonAlamaula']))
                    {
                        $busqueda = $_GET['busquedaAlamaula'];
                        $resultados = obtenerProductosAlamaula($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonFravega']))
                    {
                        $busqueda = $_GET['busquedaFravega'];
                        $resultados = obtenerProductosFravega($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonGarbarino']))
                    {
                        $busqueda = $_GET['busquedaGarbarino'];
                        $resultados = obtenerProductosGarbarino($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonMusimundo']))
                    {
                        $busqueda = $_GET['busquedaMusimundo'];
                        $resultados = obtenerProductosMusimundo($busqueda);
                        imprimirResultados($busqueda, $resultados);
                    }

                    if(isset($_GET['botonLinio']))
                    {
                        $busqueda = $_GET['busquedaLinio'];
                        $resultados = obtenerProductosLinio($busqueda);
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

                    class Producto
                    {
                        public $nombre;
                        public $precio;
                        public $link;
                        public $urlImagen;
                    }
                ?>
            </div>
        </div>
    </body>
    <script src="lib/jquery3.js"></script>
    <script src="lib/bootstrap3.js"></script>
</html>