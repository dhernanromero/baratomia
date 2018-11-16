<?php 

   class DB{

    private  $conn;

    public function __construct(){
        $this->conn = new mysqli('localhost','root','','login_google');

       }
       public function get_connection(){
           return  $this->conn;
       }

    }

?>