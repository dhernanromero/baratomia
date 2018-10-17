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
                    <h1>Prototipo de búsqueda de Garbarino:</h1>
                    <br>
                </div>
            </div>
            <div class ="row">
                <?php
                    require 'simple_html_dom.php';
                    $busqueda = $_GET['busquedaGarbarino'];
                    echo "<h4>Resultado de la búsqueda '" . $busqueda . "'</h4><br></div><div class='row'>";

                    echo '<div class="col-md-1"></div>';
                    echo '<div class="col-md-10"><table class="table table-striped table-bordered"><thead><tr><th>Imagen</th><th>Artículo</th><th>Precio</th><th>Link</th></tr></thead><tbody>';
                    $resultados = obtenerProductos($busqueda);

                    foreach($resultados as $resultado)
                    {
                        echo '<tr><td><img src="' . $resultado->urlImagen . '"></td><td>' . $resultado->nombre . '</td><td>' . $resultado->precio . '</td><td><a href="' . $resultado->link . '">' . $resultado->link . '</a></td></tr>';
                    }
                    echo '</tbody></table></div>';
                    echo '<div class="col-md-1></div>"';

                    function obtenerProductos($productoBuscado)
                    {
                        $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
                        $url = 'https://www.garbarino.com/q/' . $parseProductoBuscado . '/srch?q=' . $parseProductoBuscado;
                        $listaProductos = array();
            
                        $html = file_get_html($url);
                        $container = $html->find('div[class=row itemList]', 0);
            
                        $lista = $container->find('div[class=itemBox]');
                        
                        foreach($lista as $item)
                        {
                            $nombre = $item->find('h3[itemprop=name]', 0)->innertext;
                            $precio = $item->find('span[class=value-item]', 0)->innertext;
                            $imagen = $item->find('img[itemprop=image]', 0)->src;
                            $link = $item->find('a', 0)->href;

                            $producto = new Producto;
                            $producto->nombre = $nombre;
                            $producto->precio = $precio;
                            $producto->link = 'https://www.garbarino.com' . $link;
                            $producto->urlImagen = $imagen;

                            $listaProductos[] = $producto;
                        }
                        return $listaProductos;
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