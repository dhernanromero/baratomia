<?php

require_once('db.php');

class GoogleAuth{

    protected $client;

    public function __construct(Google_Client $googleClient = null){
        $this->client = $googleClient;
        if($this->client){
            $this->client->setClientId('895030131848-7c66md0r6t8jni9gkubjns159sv2ni4q.apps.googleusercontent.com');
            $this->client->setClientSecret('eOcW7DUquuunE0G6wQNpaNhz');
            $this->client->setRedirectUri('http://localhost/login_con_google/index.php');
            $this->client->setScopes('email');

        }     
    }
    public function isLoggedIn(){
        return isset($_SESSION['access_token']); // usuario logueado con un id de google
    }
    public function getAuthUrl(){
        return $this->client->createAuthUrl();
    }
    public function checkRedirectCode(){
        if(isset($_GET['code'])){
            $this->client->authenticate($_GET['code']);
            $this->setToken($this->client->getAccessToken());
           $payload = $this->getPayload();
       
           $this->createUser($payload);

            return true;
        }
        return false;
    }

    public function setToken($token){
        $_SESSION['access_token'] = $token;
        $this->client->setAccessToken($token);

    }

  public function logout(){
     unset($_SESSION['access_token']); 
  }  
public function getPayload(){ // retorna la informacion del usuario
     $payload = $this->client->verifyIdToken()->getAttributes();
     return $payload;
}

public function createUser($payload){ // CREA EL USUARIO EN LA BD
     $db = new DB();
     $conn = $db->get_connection();

     try{
        $query = "insert into usuario_google (id_google, email) values (?,?)";
        $statement = $conn->prepare($query);
        $statement->bind_param("ss",$payload['payload']['sub'], $payload['payload']['email']);  // sub = id(asi lo nombra google api)
       
        $statement->execute();   
     }catch(Exception $ex){

     }finally{
        $statement->close();
        $conn->close();
     }
 }

}



?>