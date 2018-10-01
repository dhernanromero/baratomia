const app = new Vue({
    el: '#app',
    data: {
        articulos : [
        ],
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
            this.$http.post('busqueda.php', { palabra: this.palabraBuscar }).then(response => {
                console.log(response);
                if (response.status === 200) {
                    var respuesta = JSON.parse( response.bodyText);
                    console.log(respuesta);
                    this.articulos = [];
                    respuesta.forEach(row => {
                        this.articulos.push({
                            nombre: row[0],
                            url: row[1],
                            imagen: row[2],
                            precio: row[3]
                        });
                    });
                    //this.articulos = items;


                }
            }, response => {
                console.error("Error");
                // error callback
            });
        }
    }
})