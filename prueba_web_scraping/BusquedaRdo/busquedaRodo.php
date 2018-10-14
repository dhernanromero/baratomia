<?php
    require_once('../simple_html_dom.php');
    
    class BusquedaRodo {
        public $PalabrasBuscar = 'notebook';
        private $CantidadBuscar = 15;
        private $Sitio = 'http://www.rodo.com.ar';
        private $Url = '';

        public function __construct(){
            $this->Url = $this->Sitio . '/catalogsearch/result/index/?limit=' . $this->CantidadBuscar . '&mode=list&q=';
        }

        public function Buscar (){

            $this->Url = $this->Url . $this->PalabrasBuscar;

            try{
     
                $html = file_get_html($this->Url);
    
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
            
                    $arrayProductos[] = array('nombre' => $nombre, 'url' => $linkUrl,'imgUrl' => $imagenUrl, 'precio'=> $precio);
                
                }
        
                return $arrayProductos;  
            } catch (Exception $e) {
                $error = 'error '. $e->getMessage();
                return  array('estado' => 'error ' );
            }

        }

    }
    
?>