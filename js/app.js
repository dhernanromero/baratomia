const app = new Vue({
    el: '#app',
    data: {
        articulos : [],
        buscadosLista : [],
        thead: {nombre:false, sitio:false, precio:false },
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
                    this.mensajeEstado = 'No se encontraron resultados para la busqueda de ' + this.palabraBuscar ;
                    this.articulos = [];
                } finally {
                    this.articulosListaComparar = [];
                    this.ocultarLoading();

                }


            }, response => {
                console.error("Error");
                this.mensajeEstado = 'No se encontraron resultados para la busqueda de ' + this.palabraBuscar ;
                this.articulos = [];
                this.ocultarLoading();

            });
        },
        //
        articuloSeleccionar: function(articulo, indexArticulo){
            articulo.seleccionado = !articulo.seleccionado;

            if(articulo.seleccionado)
            {
                console.log('checkbox seleccionado');
                if(this.articulosListaComparar.length < 2)
                {
                    this.articulosListaComparar.push(articulo);
                }
                else
                {
                    alert('Se debe seleccionar máximo 2 productos para comparar. Destilde una de las opciones anteriores para poder seleccionar el producto deseado.');
                    document.getElementById(articulo.url).checked = false;
                }
            }
            else
            {
                console.log('checkbox no seleccionado');
                for (let i = 0; i < this.articulosListaComparar.length; i++) {
                    if( this.articulosListaComparar[i] === articulo){
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
        // Ordena Articulos por Nombre
        ordenarPorNombre: function(){
            this.thead.nombre = !this.thead.nombre;

            for (const key in this.thead) {
                if (this.thead.hasOwnProperty(key)) {
                    if( key != 'nombre'){
                        this.thead[key] = false;
                    }

                }
            }

            this.articulos.sort( function(a,b){
                if (a.nombre.toLowerCase() > b.nombre.toLowerCase()) {
                    return 1;
                }
                if (a.nombre.toLowerCase() < b.nombre.toLowerCase()) {
                    return -1;
                }
                return 0;
            });
        },
        // Ordena Articulos por Sitio
        ordenarPorSitio: function(){
            this.thead.sitio = !this.thead.sitio;
            for (const key in this.thead) {
                if (this.thead.hasOwnProperty(key)) {
                    if( key != 'sitio'){
                        this.thead[key] = false;
                    }

                }
            }
            this.articulos.sort( function(a,b){
                if (a.codpagina > b.codpagina) {
                    return -1;
                }
                if (a.codpagina < b.codpagina) {
                    return 1;
                }
                return 0;
            });
        },
        // Ordena Articulos por Precio
        ordenarPorPrecio: function(){
            this.thead.precio = !this.thead.precio;
            for (const key in this.thead) {
                if (this.thead.hasOwnProperty(key)) {
                    if( key != 'precio'){
                        this.thead[key] = false;
                    }

                }
            }
            // this.articulos.sort( function(a,b){
            //     if (a.precio > b.precio) {
            //         return 1;
            //     }
            //     if (a.precio < b.precio) {
            //         return -1;
            //     }
            //     return 0;
            // });
           
            if(this.thead.precio == true){
                this.articulos.sort((a,b)=>b.precio - a.precio);
            }else{
                this.articulos.sort((a,b)=>a.precio - b.precio);
            }
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