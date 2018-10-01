<?php
//require_once('index.html');
header('Content-type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");   // Permite acceso desde otros origenes, Solo para pruebas


$post = json_decode(file_get_contents('php://input'), true);


if(isset($post['palabra'])){
    $resultado = MLTraerProducto($post['palabra']);
    echo json_encode($resultado);
}


function MLTraerProducto($art){
   // echo "entre a la funcion";
    $url = "https://api.mercadolibre.com/sites/MLA/search?q=".str_replace(" ", "+", $art);
    $Productos = json_decode(file_get_contents($url),true);

    $MLResult = array();
    for ($i=0; $i <10 ; $i++) { 
        # code...
        $var = array();
        $var[] = $Productos["results"][$i]["title"];
        $var[] = $Productos["results"][$i]["permalink"];
        $var[] = $Productos["results"][$i]["thumbnail"];
        $var[] = $Productos["results"][$i]["price"]." ".$Productos["results"][$i]["currency_id"];

        $MLResult[] = $var;
    }

    return($MLResult);
}

?>