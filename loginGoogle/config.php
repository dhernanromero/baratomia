<?php 
session_start();
require_once "GoogleAPI/vendor/autoload.php";
$gClient=new Google_Client();
$gClient->setClientId("417635768530-fr9amtspo5f50da7k4995m8fa9vvpge2.apps.googleusercontent.com");
$gClient->setClientSecret("oV8pBA15LPxPr0vdQk9wdqX3");
$gClient->setApplicationName("login con google baratomia");
$gClient->setRedirectUri("http://localhost/baratomia/loginGoogle/g-callback.php");
$gClient->setScopes('email');

 ?>