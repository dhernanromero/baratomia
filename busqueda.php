<?php
//require_once('index.html');
require_once 'clases/classWeb_scraping.php';
require_once 'clases/classMercadoLibre.php';
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");   // Permite acceso desde otros origenes, Solo para pruebas


$post = json_decode(file_get_contents('php://input'), true);


if(isset($post['palabra'])){

    $webScraping = new WebScraping;
    $mlApi = new MercadoLibreApi;

    $resultado1 = $mlApi->obtenerProductos($post['palabra']);
    $resultado2 = $webScraping->obtenerProductosGarbarino($post['palabra']);
    $resultado3 = $webScraping->obtenerProductosFravega($post['palabra']);

    $resultado = array_merge($resultado1,$resultado2,$resultado3);


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

    //var_dump ($resultado);
    
    echo json_encode($resultado);
}

?>