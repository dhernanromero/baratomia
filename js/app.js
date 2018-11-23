const app = new Vue({
    el: '#app',
    data: {
//        articulos : [],
articulos: [{"id":null,"nombre":"Protector Soul Samsung J5 Azul","precio":39,"link":"https:\/\/www.fravega.com\/protector-soul-samsung-j5-azul-593867\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3591527-280-280\/Protector-Soul-Samsung-J5-Azul.jpg?v=636694267849730000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"Protector Soul Samsung J5 Negro","precio":39,"link":"https:\/\/www.fravega.com\/protector-soul-samsung-j5-negro-594148\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3591536-280-280\/Protector-Soul-Samsung-J5-Negro.jpg?v=636694268113100000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":"MLA747053876","nombre":"Celular Samsung J2 Reacondicionadolibre + Funda Y Vt ","precio":3999,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-747053876-celular-samsung-j2-reacondicionadolibre-funda-y-vt-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/749387-MLA28114922164_092018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA747061172","nombre":"Celular Samsung J2 Prime Reacondicionado Impecable Libre","precio":4599,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-747061172-celular-samsung-j2-prime-reacondicionado-impecable-libre-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/758870-MLA28134970765_092018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA619645620","nombre":"Celular Liberado Samsung J2 Prime 4g 16gb S.o. + Memoria Sd ","precio":4999,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-619645620-celular-liberado-samsung-j2-prime-4g-16gb-so-memoria-sd-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/655707-MLA28569915156_112018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA619646200","nombre":"Samsung Galaxy J2 Prime 16gb Libre 4g Selfie Flash Garantia","precio":4999,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-619646200-samsung-galaxy-j2-prime-16gb-libre-4g-selfie-flash-garantia-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/850615-MLA27889576076_082018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA680641385","nombre":"Samsung Galaxy J2 Prime 16gb Nuevo 12 Gtia Fabrica - Techcel","precio":4999,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-680641385-samsung-galaxy-j2-prime-16gb-nuevo-12-gtia-fabrica-techcel-_JM","urlImagen":"http:\/\/mla-s2-p.mlstatic.com\/800666-MLA28193351377_092018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA660257230","nombre":"Celular Samsung Galaxy J2 Prime Liberado Quad Core 4g 16gb","precio":5099,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-660257230-celular-samsung-galaxy-j2-prime-liberado-quad-core-4g-16gb-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/627100-MLA28197870231_092018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA685151472","nombre":"Samsung Galaxy J2 Prime 16gb 4g Selfie Flash Frontal Oferta!","precio":5499,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-685151472-samsung-galaxy-j2-prime-16gb-4g-selfie-flash-frontal-oferta-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/600867-MLA27962235740_082018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA746990230","nombre":"Celular Libre Samsung J2 Prime","precio":5604,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-746990230-celular-libre-samsung-j2-prime-_JM","urlImagen":"http:\/\/mla-s1-p.mlstatic.com\/721807-MLA28397515699_102018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":"MLA736426419","nombre":"Celular Libre Samsung Galaxy J2 Prime 16 Gb Dorado","precio":5949,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-736426419-celular-libre-samsung-galaxy-j2-prime-16-gb-dorado-_JM","urlImagen":"http:\/\/mla-s2-p.mlstatic.com\/824951-MLA28237829754_092018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":null,"nombre":"Celular Libre Samsung J2 PRIME Dorado ","precio":5999,"link":"https:\/\/www.garbarino.com\/producto\/celular-libre-samsung-j2-prime-dorado\/776f022162","urlImagen":"\/\/d34zlyc2cp9zm7.cloudfront.net\/products\/370e40fcd26f39ace5795b403b8cc3d5f922f0cfc5370aaee0a3901e0279f698.jpg_250","codpagina":"GBO","pagina":"img\/garbarinologo.jpg"},{"id":null,"nombre":"Celular Libre Samsung J2 PRIME Negro","precio":5999,"link":"https:\/\/www.garbarino.com\/producto\/celular-libre-samsung-j2-prime-negro\/d74d0cabf7","urlImagen":"\/\/d34zlyc2cp9zm7.cloudfront.net\/products\/23b746ccc82f7c6bf65e0ef88f80fef5bf21715a8649de860ecb8950e86126ef.jpg_250","codpagina":"GBO","pagina":"img\/garbarinologo.jpg"},{"id":"MLA724813559","nombre":"Celular Samsung Galaxy J2 Prime Liberado ","precio":6999,"link":"https:\/\/articulo.mercadolibre.com.ar\/MLA-724813559-celular-samsung-galaxy-j2-prime-liberado-_JM","urlImagen":"http:\/\/mla-s2-p.mlstatic.com\/648485-MLA27017712405_032018-I.jpg","codpagina":"MLA","pagina":"img\/mercadolibrelogo.jpg"},{"id":null,"nombre":"2 en 1 Lenovo 14&quot; Core i3 RAM 4GB Yoga 510-14ISK","precio":24999,"link":"https:\/\/www.fravega.com\/2-en-1-lenovo-14--core-i3-ram-4gb-yoga-510-14isk-363398\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3601487-280-280\/363398_1.jpg?v=636695167075770000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 Lenovo 14&quot; Core i3 RAM 4GB Yoga 520-14IKB 80X800VL","precio":25999,"link":"https:\/\/www.fravega.com\/2-en-1-lenovo-14--core-i3-ram-4gb-yoga-520-14ikb-80x800vl-363261\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3625770-280-280\/363261_1.jpg?v=636717593864100000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 Lenovo 14&quot; Core i5 RAM 8GB Yoga 520-14IKB 80X8014N","precio":32999,"link":"https:\/\/www.fravega.com\/2-en-1-lenovo-14--core-i5-ram-8gb-yoga-520-14ikb-80x8014n-363232\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3601571-280-280\/363232_1.jpg?v=636695167746330000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 Asus 13.3&quot; Core i5 RAM 8GB UX360UAK-C4246T","precio":33999,"link":"https:\/\/www.fravega.com\/2-en-1-asus-13-3--core-i5-ram-8gb-ux360uak-c4246t-363222\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3601375-280-280\/362998_1.jpg?v=636695165778230000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 Asus 13.3&quot; Core i7 RAM 8 GB UX370UA-C4308T","precio":49999,"link":"https:\/\/www.fravega.com\/2-en-1-asus-13-3--core-i7-ram-8-gb-ux370ua-c4308t-363356\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3774763-280-280\/363356_1.jpg?v=636729483042670000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 Lenovo 13.9&quot; Core i5 RAM 8GB Yoga 910-13IKB","precio":49999,"link":"https:\/\/www.fravega.com\/2-en-1-lenovo-13-9--core-i5-ram-8gb-yoga-910-13ikb-363409\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/3601643-280-280\/363409_1.jpg?v=636695168239870000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"2 en 1 HP 15.6&quot; Core i7 RAM 12GB Envy x360 15-CN0052LA","precio":57999,"link":"https:\/\/www.fravega.com\/2-en-1-hp-15-6--core-i7-ram-12gb-envy-x360-15-cn0052la-363352\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/4033048-280-280\/2-en-1-HP-15.6--Core-i7-RAM-12GB-Envy-x360-15-CN0052LA-363352.jpg?v=636759005229400000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"},{"id":null,"nombre":"Lavasecarropas Samsung WD10J6410AX","precio":59499,"link":"https:\/\/www.fravega.com\/lavasecarropas-samsung-wd10j6410ax-10010305\/p","urlImagen":"https:\/\/fravega.vteximg.com.br\/arquivos\/ids\/4042969-280-280\/image-44d4a4ca8f2f4bc2a3452fb54151ad95.jpg?v=636765062542870000","codpagina":"FRV","pagina":"img\/fravegalogo.jpg"}],

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
                } finally {
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
        // De los articulos seleccionados Envia datos y muesta detalles
        comprarArticulos:  function(){
            console.info('Iniciando comparacion');
            //window.open("comparacion.php", "nombre de la ventana", "width=300, height=200");
            var url = "comparacion.php" + "?";
            
            for (let i = 0; i < this.articulosListaComparar.length; i++) {
                //url += 'url=' +  escape( this.convertirB64( this.articulosListaComparar[i].url) )+'&'
                url += 'url=' +  escape( this.convertirB64( JSON.stringify(this.articulosListaComparar[i]) ) )+'&'

                
            }
            window.open(url, "Comparaciones");
            console.log(url);

// JSON.stringify(obj)
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
    }
})