const app = new Vue({
    el: '#app',
    data: {
        articulos : [],
        buscadosLista : [],
        palabraBuscar: '',
        articulosListaComparar :[]
    },
    methods: {
        buscarPalabra: function(){
            console.log("Buscando...");
            console.log(this.palabraBuscar);
            this.articulos.forEach(elemento => {
               if(elemento.nombre == this.palabraBuscar){
                   console.log(true);
                   elemento.mostrar = true;
               } else {
                   elemento.mostrar = false;
               }
            });
        },
        // Inicia Busqueda y muestra resultados por medio de AJAX
        iniciarBusqueda: function(){
            // Borra array con Articulos Seleccionados
            this.articulosComparar = [];

            console.info('INCIANDO CONSULTA AJAX');
            var palabras = this.palabraBuscar;
            patron = /[ ]/gi;            
            palabrasBuscar = palabras.replace(patron, '-');
        
            console.info(palabrasBuscar);
            this.$http.post('busqueda.php', { palabra: palabrasBuscar }).then(response => {
                console.log(response);
                if (response.status === 200) {
                    var respuesta = JSON.parse( response.bodyText);
                    console.log(respuesta);
                    this.articulos = [];
                    console.log('longitud: ', respuesta.length);
                    respuesta.forEach(row => {
                        this.articulos.push({
                            // nombre: row[0],
                            // url: row[2],
                            // imagen: row[3],
                            // precio: row[1]
                            nombre: row.nombre,
                            url: row.link,
                            imagen: row.urlImagen,
                            precio: row.precio,
                        });
                    });
                    //this.articulos = items;

                    // CORREGIR CADA CLASE de Busqueda!!!
                    // Agrega palabra a Lista de Buscados, Se debe corregir en el servidor para cuando no se encuentren
                    // resultados, retorne un JSON vacio, porque por el momento retorn el error.

                    this.buscadosLista.push(this.palabraBuscar);
                }
            }, response => {
                console.error("Error");
                // error callback
            });
        },
        //
        articuloSeleccionar: function(articulo, indexArticulo){
            articulo.seleccionado = !articulo.seleccionado;

            if( articulo.seleccionado ){
                console.log(true);
                this.articulosListaComparar.push(articulo);

            }else {
                console.log(false);
                for (let i = 0; i < this.articulosListaComparar.length; i++) {
                    if( this.articulosListaComparar[i] == articulo){
                        this.articulosListaComparar.splice(i, 1)
                    }
                    
                }
            }

            console.log('selecciono: ',articulo);
            

        },
        // De los articulos seleccionados Envia datos y muesta detalles
        comprarArticulos:  function(){
            console.info('Iniciando comparacion');
        }

    }
})