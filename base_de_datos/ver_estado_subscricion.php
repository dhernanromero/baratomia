<?php  
  /*  session_start();
    if(!isset($_SESSION["usuario"]))
    {
    header("Location:index.php");
	}

$mail=$_SESSION["usuario"];
*/

print_r($_POST);
$mail=$_POST["emailsesion"];
	


try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$ver_estado="select estado_notificaciones_id_estado_notificacion from usuarios where usuarios.mail=:correo";
	$resultado=$base->prepare($ver_estado);
	
	$resultado->bindParam(":correo",$mail);
	$resultado->execute();
	$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	if ($registro["estado_notificaciones_id_estado_notificacion"]==1) {
		echo "activado";
	}
	else{
		echo "desactivado";
	}
	//$resultado->closeCursor();

}



catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>