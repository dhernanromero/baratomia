<?php 
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql="select * from usuarios where mail =:email"; //and password=:pass ";
	$resultado=$base->prepare($sql);

	$email=$_POST["mail"];
	$password=$_POST["passlogin"];

	$resultado->execute(array(":email"=>$email));

	$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	if(password_verify( $password,$registro['password']))
	{
		session_start();
		$_SESSION["usuario"]=$_POST["mail"];
		header("location:../index2.php");

	}
	else{

		echo ("pendiente:enviar un error al modal del login");
	}

	
} catch (Exception $e) {

	die("Error:".$e->getMessage());
	
}












 ?>