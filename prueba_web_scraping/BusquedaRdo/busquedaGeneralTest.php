<?php
    require_once('busquedaRodo.php');
    header('Content-type: application/json; charset=utf-8');

   if (isset($_POST["palabrasBuscar"])) {
        $palabra = $_POST["palabrasBuscar"];
        $array = array( 'palabra' => $palabra);

        $busqueda = new BusquedaRodo();
        $busqueda->PalabrasBuscar = $palabra;
        $resultado = $busqueda->Buscar();
        echo json_encode($resultado);

    } else {
        
        echo json_encode(array('estado' => 'No Var'));
    }


?>
