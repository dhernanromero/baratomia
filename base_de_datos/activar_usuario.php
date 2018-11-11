<?php 	
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$sqlactivar="update usuarios set estado_idEstado=:estado where cod_activacion =:codigo";
	$activar=$base->prepare($sqlactivar);
	$activo=1;
	$code=$_GET['link'];
	$activar->bindParam(":estado",$activo);
	$activar->bindParam(":codigo",$code);
	$activar->execute();
	$activar->closeCursor();
	echo"la cuenta fue activada";
	header("location:../base_de_datos/cuenta_activada.html");
	
	
} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}






 ?>