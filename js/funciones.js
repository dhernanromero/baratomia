$(document).ready(function() {


	$("#login").click(function() {
		$("#password").val("");
		$("#botongoogle").val("LOGUEATE CON GOOGLE");
		$("#estado").attr('type', 'button');
		$("#estado").attr('id', 'estadologin');
		$("#incompleto").prepend('<a href="base_de_datos/reenviar_mail.php">Presione aqui si no recibio el mail de activacion</a>');

		$("#formulario").attr("action","base_de_datos/login.php");
		$(".modal,.fade").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#estadologin").val("Iniciar Sesion");
		$("#ocultar").hide();
		$('#mail').attr('id', 'maillog');
		$("#maillog").on('input', function(event) {
			$("#incompleto").text('');
		});
		$("#passwordLogin").on('input',function(event) {
			event.preventDefault();
			$("#incompleto").text('');
		});


		  $("#passwordLogin").val('');

		  $("#passwordLogin").show();
		  $("#password").hide();
		  $("#password").attr('required', false);
		  $("#passwordLogin").attr('required', true);
		  $("#resultado").hide();

		  $("#estadologin").click(function(e) {
		  	if($("#maillog").val().length<=0 && $("#passwordLogin").val().length<=0){
		  	$("#incompleto").text('ambos campos deben ser completados');
		  	e.preventDefault();

		  	}


		  	else if($("#passwordLogin").val().length<=0){
		  		$("#incompleto").text('complete el campo password');
		  		e.preventDefault();
		  	}

		  	

		  	else if($("#maillog").val().length<=0){
		  		$("#incompleto").text('complete el campo mail');
		  		e.preventDefault();

		  	}
		  	else{
		  	var correo=$('#maillog').val();
		  	var pass=$("#passwordLogin").val();
		  	param={"mail":correo,"pass":pass};
		  	
		  	$.ajax({
                data:  param,
                url:   'base_de_datos/login.php',
                type:  'post',
                beforeSend: function () {
                       
                },
                success:  function (response) {
                	    var respuesta=response;
                        if (respuesta!="activar" && respuesta!=="error") {
                        	$(location).attr("href","index2.php");

                        }
                        else if(respuesta=="activar"){
                        	$("#incompleto").html("la cuenta debe ser activada por mail para ingresar");
                        }
                        else if(respuesta=="error"){
                        	$("#incompleto").html("error en el usuario o password");
                        }     
                        
                        
                        
                },
                error: function(response){
                	alert(response);
                }
        });}
		  });


		  


	});


	var continuar=true;


	$("#registro").click(function() {
		$("#estado").off();
		
		$("#estado").attr('type', 'submit');
		$("#botongoogle").val("REGISTRATE CON GOOGLE");

		$('#maillog').attr('id', 'mail');
		
		$("#formulario").attr("action","base_de_datos/insertarusuario.php");
		$(".modal,.fade").attr('id','formregistro');
		$("#exampleModalLabel").text("Registrate");
		$("#ocultar").show();
		$("#estado").val("Registro");
		
		  $("#password").show();
		  $("#password").attr('required', true);
		  $("#passwordLogin").hide();
		  $("#passwordLogin").attr('required', false); 
		  $("#resultado").show();

		$("#mail").on('input', function(event) {
			$("#incompleto").text('');
		});



		$("#passwordR").on("input",function(e){ 
		$("#incompleto").text('');
		$("#passwordR").attr('class', '');
		$("#password").attr('class', '');
		$(".imagenchica").attr('src', '');
		if ($("#passwordR").val().length==12) {
		if ($("#password").val()===$("#passwordR").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
			$(".imagenchica").attr('src', 'base_de_datos/ok.png');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			$(".imagenchica").attr('src', 'base_de_datos/error.png');
			
		}}
		});

		//
		$("#password").on("input",function(e){ 
			$("#incompleto").text('');
			$("#passwordR").attr('class', '');
			$("#password").attr('class', '');
			$(".imagenchica").attr('src', '');
		if ($("#password").val().length==12 && $("#passwordR").val().length==12) {	
		if ($("#passwordR").val()===$("#password").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
			$(".imagenchica").attr('src', 'base_de_datos/ok.png');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			$(".imagenchica").attr('src', 'base_de_datos/error.png');
			
		}
	}
	//

		});

	
	console.log(continuar);
	$("#estado").click(function(e) {
		if(continuar!=true){
			$("#incompleto").text('Error ingrese un mail distinto');
			e.preventDefault();}

		if ($("#password").val()===$("#passwordR").val()){
			console.log("bien");
		}
		else{
			$("#incompleto").text('Error los password no coinciden');
			e.preventDefault();

		}
	});

	function verificar_existencia(){
		var correo=$('#mail').val();
		var parametros={
			"email":correo,
		};
		 $.ajax({
                data:  parametros,
                url:   'base_de_datos/existemail.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        var respuesta=response.trim();
                        if (respuesta ==="ERROR") {
            
                        	$("#resultado").html("Este mail ya existe, por favor ingrese otro");
                        	continuar=false;
                        }
                        else if (respuesta==="Google") {
                        	$("#resultado").html("Este mail esta registrado por google pero puede continuar con el registro por mail y password.");
                        	continuar=true;

                        }
                        else if (respuesta==="ERROR2") {
                        	$("#resultado").html("Este mail ya existe, por favor ingrese otro");
                        	continuar=false;

                        }


                        else{
                        	if(correo==""){
                        		$("#resultado").html("por favor complete el campo mail");
                        	}
                        	else{
                        	$("#resultado").html("ok");
                        	continuar=true;
                        }
                        }
                }
        });

	}


	$("#mail").blur(function(event) {
		verificar_existencia();
	});
	$('#mail').keyup(function(event) {
		verificar_existencia();
	});
	
	});

	$("#password,#passwordR,#passwordLogin").on('input', function(e) {
		if (!/^[ a-zA-Z0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
	};
	});

	
	$('.modal ,.fade').on('hidden.bs.modal', function (e) {
		$("#mail").val("");
		$("#maillog").val("");
		$("#passwordR").val("");
		$("#password").val("");
		$("#password").attr('class', '');
		$("#passwordR").attr('class', '');
		$("#incompleto").text('');
		$(".modal,.fade").attr('id','');
		$(".imagenchica").attr('src', '');
		$("#formulario").attr("action","");
		$("#resultado").html("");
		$("#estadologin").attr('id', 'estado');
		
		
		continuar=true;

	});

	$("#volver").click(function(event) {
		$(location).attr('href',"../index.php");
	});

	$("#mail_envio").on('input', function(event) {
		$("#incompleto_envio").text('');
		
	});
	$("#password_envio").on('input', function(event) {
		$("#incompleto_envio").text('');
		
	});

/////////aca no me cambia el radio 
activadar_desactivado=false;
desactivar_activado=false;
$("#radio-desactivado").attr('checked',activadar_desactivado);
$("#radio-activado").attr('checked',desactivar_activado);


	$("#irconfig").click(function(event) {
		
		var correo=$('#mailsesion').text();
		var datos={
			"emailsesion":correo
		};
		 $.ajax({
                data:  datos,
                url:   'base_de_datos/ver_estado_suscripcion.php',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
                        var respuesta=response.trim();
                        //alert(respuesta);
                        if (respuesta =="desactivado") {
  
                        	//alert("entra en desactivado");
                        	activadar_desactivado=true;
                        	desactivar_activado=false;
                        }
                        else{

                        	
                        	activadar_desactivado=false;
                        	desactivar_activado=true;
                        	//alert(desactivar_activado);
                        }
                }
        });



		
	});



});

