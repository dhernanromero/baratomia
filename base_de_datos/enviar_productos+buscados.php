<?php 

try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$productos="SELECT nombre FROM productosmasbuscados;";
	$resultado=$base->prepare($productos);
	$resultado->execute();
    $nombre_obtenido="";
    while ($nombre = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $nombre_obtenido=$nombre['nombre'];
    }
//////////////////////////////
   

	$asunto="envio a varios mail";

	$desde="From:"."Baratomia";
	$mensajes=$nombre_obtenido;



/////////////////////////////


	$mails_suscriptos="select mail from usuarios where estado_notificaciones_id_estado_notificacion=1;";
	$datos=$base->prepare($mails_suscriptos);
	$datos->execute();
	while ($registros = $datos->fetch(PDO::FETCH_ASSOC)) {
    mail($registros['mail'],$asunto,$mensajes,$desde);
    /*echo $registros['mail']."<br>";
    echo $nombre_obtenido."<br>";*/
	}




	//$datos->closeCursor();



}



catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}

















 ?>