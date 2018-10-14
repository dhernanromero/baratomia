<?php
  require_once('simple_html_dom.php');
  header('Content-type: application/json; charset=utf-8');
  
      $html = file_get_html('http://www.rodo.com.ar/informatica/notebooks.html?limit=25&mode=list');
  
      $contenedorProductos = $html->find('div[class=category-products]',0);
  
      $boxs = $contenedorProductos->find('div[class=list-box]');
  
      $arrayProductos = array();
      foreach ($boxs as $divProducto) {
        
        $productoBox = $divProducto->find('div[class=product-shop');
        $link = $divProducto->find('h2 a',0);
        $linkUrl = $link->attr['href'];
        $nombre = $link->innertext;
        $imagen = $divProducto->find('img',0);
        $imagenUrl = $imagen->attr['src'];
        $spanPrecio = $divProducto->find('span[class=price]',0);
        $precio = $spanPrecio->innertext;
     /*
        echo $linkUrl;
        echo '<br>';
      echo $nombre;
    echo '<br>';
    echo $imagenUrl;
      echo '<br>';
      echo $precio;
    echo '<br>';
     */

      $arrayProductos[] = array('nombre' => $nombre, 'url' => $linkUrl,'imgUrl' => $imagenUrl, 'precio'=> $precio);
     
    }

    echo json_encode($arrayProductos);  


?>