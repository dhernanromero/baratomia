<?php
  $url = $_SERVER['REQUEST_URI'];
  $parametros = explode('?', $url)[1];
  $articulos = explode('url=', $parametros );
 //echo ( $url);
 echo('<br>');
 echo('<br>');

 //echo ($parametros);
 echo('<br>');
 echo('<br>');

print_r($articulos);


 echo('<br>');
 echo('<p>Listas de URLS');

 echo('<p>---------------------------------------</p>');

  foreach ($articulos as $valor) {
    echo('<br>');
    echo( '<a href='.base64_decode( $valor ).' target="_blank" >'.  base64_decode( $valor ) . '</a>');
    echo('<br>');
  }

 echo('<br>');



?>

