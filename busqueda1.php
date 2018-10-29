<?php
//require_once('index.html');
require_once 'clases/classWeb_scraping.php';
require_once 'clases/classMercadoLibre.php';
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");   // Permite acceso desde otros origenes, Solo para pruebas


$post = json_decode(file_get_contents('php://input'), true);

$post['palabra']= 'PS4';

if(isset($post['palabra'])){
    $webScraping = new WebScraping;
    $mlApi = new MercadoLibreApi;
    //$busqueda;
    //$resultados;

    $resultado1 = $mlApi->obtenerProductos($post['palabra']);
    $resultado2 = $webScraping->obtenerProductosGarbarino($post['palabra']);

    $resultado = array_merge($resultado1,$resultado2);

    $nombre = array(); 
    $link = array(); 
    $imagen = array();
    $precio = array();
    
    foreach($resultado as $key=>$val) { 
        array_push($nombre, $val->nombre); 
        array_push($link, $val->link);
        array_push($imagen, $val->urlImagen);
        array_push($precio, $val->precio); 
    } 
    
    array_multisort($precio, SORT_ASC, $resultado); 

    var_dump ($resultado);
    
}

// function MLTraerProducto($art){
//    // echo "entre a la funcion";
//     $url = "https://api.mercadolibre.com/sites/MLA/search?q=".str_replace(" ", "+", $art);
//     $Productos = json_decode(file_get_contents($url),true);

//     $MLResult = array();
//     for ($i=0; $i <10 ; $i++) { 
//         # code...
//         $var = array();

//         $var[] = $Productos["results"][$i]["title"];
//         $var[] = $Productos["results"][$i]["permalink"];
//         $var[] = $Productos["results"][$i]["thumbnail"];
//         //$var[] = $Productos["results"][$i]["price"]." ".$Productos["results"][$i]["currency_id"];
//         $var[] = (float)$Productos["results"][$i]["price"];
//         //$prd = new Producto;

//         // $prd->nombre  = $Productos["results"][$i]["title"];
//         // $prd->url = $Productos["results"][$i]["permalink"];
//         // $prd->imagen  = $Productos["results"][$i]["thumbnail"];
//         // $prd->precio = $Productos["results"][$i]["price"]." ".$Productos["results"][$i]["currency_id"];

//         $MLResult[] = $var;
//     }

//     return $MLResult;
// }

// function AMTraerProducto($busqueda){
//     require 'simple_html_dom.php';
//     //echo "entre a la funcion";
//     //$busqueda = $_GET['busqueda'];
//     //echo "<h3>Resultado de la búsqueda '" . $busqueda . "'</h3><br>";
//     $parseBusqueda = str_replace(' ', '+', $busqueda);
//     $url = 'https://www.alamaula.com/s-' . $parseBusqueda . '/v1q0p1';

//     $html = file_get_html($url);
    
//     //echo "completo variable html <br>"; 

//     $container = $html->find('div[class=view]', 0);

//     //echo "variable $container <br>";
//     if($container->class == 'view top-listings')
//     {
//         $container = $html->find('div[class=view]', 1);
//     }

//     $lista = $container->find('ul', 0);
//     $items = $lista->find('li');

//     //echo '<table><tr><th>Imagen</th><th>Articulo</th><th>Descripcion</th></tr>';
//     $AMResult = array();
//    // echo "llegue al foreach";
//     try {
        
//         foreach($items as $item)
//         {
//             $divGeneral = $item->find('div', 0);
//             $divContenedor = $divGeneral->find('div[class=container]', 0);
//             //$divThumb = $divGeneral->find('div[class=thumb shrtHght]', 0);
//             //$divImg = $divThumb->find('div[id=img-cnt]', 0);
//             //$img = $divImg->find('img', 0);
//             //$srcImg = $img->src;
//             $divTitulo = $divContenedor->find('div[class=title]', 0);
//             $divDescripcion = $divContenedor->find('div[class=description]', 0);
//             $divInfo = $divContenedor->find('span[class=amount]',0);
//             $precio = $divInfo->innertext;


//             $divlink = $divContenedor->find('div[class=title]', 0);
//             $prelink = $divlink->find('a', 0);
//             $link = $prelink->href;

//             /********* Obtengo la thumbails  **********/
//             /*** Busco la imagen por el META de Face de la pagina detalle */
//             /*<meta property="og:image" content='https://i.ebayimg.com/00/s/ODAwWDYwMA==/z/XAkAAOSwGgdbvecx/$_20.JPG'/>*/
//             $url_img = 'https://www.alamaula.com'.$link;
//             $html_img = file_get_html($url_img);
//             $divImg = $html_img->find('meta[property="og:image"]', 0);
//             $srcImg = $divImg->content;
            
//             $titulo = $divTitulo->find('a', 0)->innertext;
//             $descripcion =  $divDescripcion->innertext;
//             //echo '<tr><td><img src="' . $srcImg . '" class="thumbM"></td><td>' . $titulo . $precio . '</td><td>' . $descripcion . '</td><td><a href='.$url_img.'>'.$link.'</a></td></tr>';
            
//          //   echo "dentro del for";
            
//             $var = array();

//             $var[] = $titulo;
//             $var[] = $link.$url_img;
//             $var[] = $precio;
//             $var[] = $srcImg;

//             $AMResult[] = $var;
//         }
//         print_r($AMResult);
//      } catch (Exception $e) {
//         print_r($AMResult);
//     }
// }


// function GBTraerProducto($productoBuscado){
//     require_once 'simple_html_dom.php';
//     $parseProductoBuscado = str_replace(' ', '+', $productoBuscado);
//     $url = 'https://www.garbarino.com/q/' . $parseProductoBuscado . '/srch?q=' . $parseProductoBuscado;
//     $listaProductos = array();

//     $html = file_get_html($url);
//     $container = $html->find('div[class=row itemList]', 0);

//     $lista = $container->find('div[class=itemBox]');
    
//     foreach($lista as $item)
//     {
//         $nombre = $item->find('h3[itemprop=name]', 0)->innertext;
//         $precio = $item->find('span[class=value-item]', 0)->innertext;
//         $imagen = $item->find('img[itemprop=image]', 0)->src;
//         $link = $item->find('a', 0)->href;

//         $var = array();

//         $var[] = trim($nombre);
//         $var[] = trim('https://www.garbarino.com' . $link);
//         $var[] = trim($imagen);
//         //$var[] = trim($precio);
//         $precio_obtengo = substr(trim($precio),1);
//         $precio_tranformo = str_replace(".", "", $precio_obtengo);
//         $var[] = (float)$precio_tranformo;
//         // $producto = new Producto;
//         // $producto->nombre = trim($nombre);
//         // $producto->url = trim('https://www.garbarino.com' . $link);
//         // $producto->imagen = trim($imagen);
//         // $producto->precio = trim($precio);

//         $listaProductos[] = $var;
//     }
//     return $listaProductos;
// }


//AMTraerProducto("ps4");
?>