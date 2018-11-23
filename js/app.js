const app = new Vue({
    el: '#app',
    data: {
        articulos : [],
        buscadosLista : [],
        palabraBuscar: '',
        articulosListaComparar :[],
        mensajeEstado: ''
    },
    methods: {

        // Inicia Busqueda y muestra resultados por medio de AJAX
        iniciarBusqueda: function(){
            // Borra array con Articulos Seleccionados
            this.articulosComparar = [];
            this.mensajeEstado = '';
            console.info('INCIANDO CONSULTA AJAX');
            
            var palabras = this.palabraBuscar;
            patron = /[ ]/gi;            
            palabrasBuscar = palabras.replace(patron, '-');
        
            console.info(palabrasBuscar);
            this.mostrarLoading();

            
            this.$http.post('busqueda.php', { palabra: palabrasBuscar }).then(response => {
                console.log(response);
                try {
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
                                id: row.id,
                                nombre: row.nombre,
                                url: row.link,
                                imagen: row.urlImagen,
                                precio: row.precio,
                                codpagina: row.codpagina,
                                pagina: row.pagina,
                            });
                        });
                        //this.articulos = items;
    
                        // CORREGIR CADA CLASE de Busqueda!!!
                        // Agrega palabra a Lista de Buscados, Se debe corregir en el servidor para cuando no se encuentren
                        // resultados, retorne un JSON vacio, porque por el momento retorn el error.
                        this.buscadosLista.push(this.palabraBuscar);
                        this.palabraBuscar = '';
                        this.mensajeEstado = 'Se econtron ' + this.articulos.length + ' resultados para la busqueda';
                    }
                } catch (error) {
                    console.error('Error ', error);
                    this.mensajeEstado = 'No se encontraron resultados para la busqueda de' + this.palabraBuscar ;
                    this.articulos = [];
                } finally {
                    this.articulosListaComparar = [];
                    this.ocultarLoading();

                }


            }, response => {
                console.error("Error");
                this.ocultarLoading();

            });
        },
        //
        articuloSeleccionar: function(articulo, indexArticulo){
            articulo.seleccionado = !articulo.seleccionado;

                //this.articulosListaComparar.push(articulo);

 
            if( articulo.seleccionado && this.articulosListaComparar.length < 2 ){
                console.log(true);
                this.articulosListaComparar.push(articulo);

            }else {
                console.log(false);
                articulo.seleccionado = !articulo.seleccionado;

                for (let i = 0; i < this.articulosListaComparar.length; i++) {
                    if( this.articulosListaComparar[i] == articulo){
                        this.articulosListaComparar.splice(i, 1)
                    }
                    
                }
            }

            console.log('selecciono: ',articulo);
            

        },
        // De los articulos seleccionados Envia datos y muesta detalles en comparacion.php
        comprarArticulos:  function(){
            console.info('Iniciando comparacion');
            //window.open("comparacion.php", "nombre de la ventana", "width=300, height=200");
            var url = "comparacion.php" + "?";
            
            for (let i = 0; i < this.articulosListaComparar.length; i++) {
                //url += 'url=' +  escape( this.convertirB64( this.articulosListaComparar[i].url) )+'&'
                url += 'url=' +  escape( this.convertirB64( JSON.stringify(this.articulosListaComparar[i]) ) )+'&'
             
            }
            window.open(url, "Comparaciones");
            //console.log(url);
            //$('#modalComparacion').modal('show');
        },
        // Pasa Variables y Abre Pagina Comparar.php
        convertirB64: function (txt) {
            return window.btoa(unescape(encodeURIComponent(txt)));
        },
        // Muestra Loading
        mostrarLoading: function(){
            console.log('mostrar loading');
            $("#loading").css("display", "block");
        },
        // Oculta Loading
        ocultarLoading: function(){
            $("#loading").css("display", "none");
        }
    },
    computed: {
        listaComparacion2: function(){

        }
    },
})