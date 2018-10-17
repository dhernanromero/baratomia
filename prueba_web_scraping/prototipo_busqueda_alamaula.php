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
                    <h1>Prototipo de búsqueda de Alamaula:</h1>
                    <br>
                </div>
            </div>
            <div class ="row">
                <?php
                    require 'simple_html_dom.php';
                    $busqueda = $_GET['busquedaAlamaula'];
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
                        $url = 'https://www.alamaula.com/s-' . $parseProductoBuscado . '/v1q0p1';
                        $listaProductos = array();
            
                        $html = file_get_html($url);
                        $container = $html->find('div[class=view]', 0);
                        if($container->class == 'view top-listings')
                        {
                            $container = $html->find('div[class=view]', 1);
                        }
            
                        $lista = $container->find('ul', 0);
                        $items = $lista->find('li');
                        
                        foreach($items as $item)
                        {
                            $divGeneral = $item->find('div', 0);
                            $divContenedor = $divGeneral->find('div[class=container]', 0);
                            $divThumb = $divGeneral->find('div[class=thumb shrtHght]', 0);
                            $divImg = $divThumb->find('div[id=img-cnt]', 0);
                            $img = $divImg->find('img', 0);
                            $srcImg = $img->src;
                            $divTitulo = $divContenedor->find('div[class=title]', 0);
                            $divDescripcion = $divContenedor->find('div[class=description]', 0);
                            $titulo = $divTitulo->find('a', 0)->innertext;
                            $divPrecio = $divContenedor->find('div[class=info]', 0);
                            $precio = $divPrecio->find('span[class=amount]');
                            $link = $divTitulo->find('a', 0)->href;
                            $descripcion =  $divDescripcion->innertext;

                            if(count($precio) == 0)
                            {
                                $precio = array('$0');
                            }

                            $producto = new Producto;
                            $producto->nombre = $titulo;
                            $producto->precio = $precio[0];
                            $producto->link = 'https://www.alamaula.com' . $link;
                            $producto->urlImagen = $srcImg;

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