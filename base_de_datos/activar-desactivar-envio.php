<?php  
    session_start();
    if(!isset($_SESSION["email"]))
    {
    header("Location:index.php");
	}
$valor=$_POST["seleccionar"];

$mail=$_SESSION["email"];

$estadonotificacion;
$activo=1;
$inactivo=0;

try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");;
	$activar_desactivar="update usuarios SET estado_notificaciones_id_estado_notificacion=:valor WHERE usuarios.mail=:correo and estado_idEstado=1 or estado_idEstado=2 ;";//ver aca por q la logica no funciona.
	$actualizar=$base->prepare($activar_desactivar);
	$actualizar->bindParam(":correo",$mail);
	if ($valor=="activar") {
		$actualizar->bindParam(":valor",$activo);
		
	}
	else{
		$actualizar->bindParam(":valor",$inactivo);
		
	}
	$actualizar->execute();
	$actualizar->closeCursor();
	echo('<script type="text/javascript">
        alert("Configuracion Guardada");
        window.location.href="../index2.php";
        </script>');

}



catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>