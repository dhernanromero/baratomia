$(document).ready(function() {
	$("#login").click(function() {
		$("#password").val("");
		$("#estado").attr('type', 'button');
		$("#estado").attr('id', 'estadologin');


		$("#formulario").attr("action","base_de_datos/login.php");
		$(".modal,.fade").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#estadologin").val("Iniciar Sesion");
		$("#ocultar").hide();
		$('#mail').attr('id', 'maillog');
		$("#maillog").on('input', function(event) {
			$("#incompleto").text('');
		});


		  $("#passwordLogin").val('');

		  $("#passwordLogin").show();
		  $("#password").hide();
		  $("#password").attr('required', false);
		  $("#passwordLogin").attr('required', true);
		  $("#resultado").hide();//testear posible error de campo requerido?

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
		  	console.log("lofin");
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
		
		$("#estado").attr('type', 'submit');//esto no es el problema
		


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
		  $("#resultado").show();//testear posible error de campo requerido?

		$("#mail").on('input', function(event) {
			$("#incompleto").text('');
		});



		$("#passwordR").on("input",function(e){ 
		$("#incompleto").text('');
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
			
		}
		});

		$("#password").on("input",function(e){ 
			$("#incompleto").text('');
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


	$('#mail').keyup(function(event) {
		var correo=$('#mail').val();
		var parametros={
			"email":correo,
		};
		//console.log(parametros);
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
		$("#estadologin").attr('id', 'estado');//tampoco este
		
		
		continuar=true;

	});

	

});

