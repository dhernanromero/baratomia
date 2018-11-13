<?php 
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql="select * from usuarios where mail =:email";
	$resultado=$base->prepare($sql);

	$email=$_POST["mail"];
	$password=$_POST["pass"];

	$resultado->execute(array(":email"=>$email));

	$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	if(password_verify( $password,$registro['password']))
	{
		if ($registro['estado_idEstado']==0)
		{
			echo "activar";
		}
		else{
			session_start();
			$_SESSION["usuario"]=$_POST["mail"];
			header("location:../index2.php");
			echo "ok";

		}

	}
	else{

		echo ("error");
	}

	
} catch (Exception $e) {

	die("Error:".$e->getMessage());
	
}












 ?>