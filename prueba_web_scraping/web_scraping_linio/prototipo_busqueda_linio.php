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
                    <h1>Prototipo de búsqueda de linio:</h1>
                    <br>
                </div>
            </div>
            <div class ="row">
                <?php
                    require 'simple_html_dom.php';
                    $busqueda = $_GET['busquedaLinio'];
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
                        $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);  // utiliza + para separar palabras
                        $url = 'https://www.linio.com.ar/search?q=' . $parseProductoBuscado ;  // url de la pagina en busqueda . concatenacion
                        $listaProductos = array();

                        $html = file_get_html($url); // trae el archivo plano del html
                       // $catalogue_product = $html->find('div[class=catalogue-product-sm-container switchable-product-container row]'); 
                        $catalogue_item = $html->find('div[class=catalogue-product row]');

                        foreach($catalogue_item as $item) // buscar las direcciones de los elementos
                        {
                         
                            $ahref = $item->find('a',0);
                            $nombre = $ahref->find('meta[itemprop=name]',0)->content;
                            $image_container = $ahref->find('div[class=image-container]',0);//llama a la clase padre
                            $imagen =  $image_container->find('img',0);
                            $source = $image_container->find('source[type=image/jpeg]',0);
                            $detail_container = $ahref->find('div[class=detail-container]',0); //llama a la clase padre
                            $price_section = $detail_container->find('div[class=price-section]',0);
                            $precio = $price_section->find('meta[itemprop=price]',0)->content;
                            $link=  'https://www.linio.com.ar' . $ahref->href;

                            $producto = new Producto; //guardo los elementos en objetos
                            $producto->nombre = $nombre;
                            $producto->precio= $precio;
                            $producto->link= $link;
                            $producto->urlImagen = $imagen;

                            $listaProductos[] = $producto; // lista guarda los elementos producto

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