const app = new Vue({
    el: '#app',
    data: {
        articulos : [],
        buscadosLista : [],
        palabraBuscar: '',
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
        iniciarBusqueda: function(){
            console.info('INCIANDO CONSULTA');
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
        }
    }
})