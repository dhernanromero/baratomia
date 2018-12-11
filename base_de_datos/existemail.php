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
		$tienetoken="select token_gmail,password from usuarios where mail=:correo";
		$verificar=$base->prepare($tienetoken);
		$verificar->bindParam(":correo",$mail);
		$verificar->execute();
		$resultante=$verificar->fetch(PDO::FETCH_ASSOC);
		if ($resultante['token_gmail']!==NULL and  $resultante['password']==="0") {///asi esta bien la logica
			echo "Google";

		}
		elseif($resultante['token_gmail']!==NULL and $resultante['password']!=="0"){///asi esta bie la logica
			echo "ERROR2";	
		}
		
		

			



		///////
		else{
		echo "ERROR";
		}
	



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



