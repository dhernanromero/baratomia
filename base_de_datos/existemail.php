<?php 
$mail=$_POST["email"];

try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$existe="select *from usuarios where mail=:correo";
	$comprobar=$base->prepare($existe);
	$comprobar->bindParam(":correo",$mail);
	$comprobar->execute();
	$resultado=$comprobar->fetchAll();
	if($resultado){
		echo "ERROR";
		
	}
	else {
		echo "OK";
	}



} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>



