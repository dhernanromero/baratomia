$(document).ready(function() {
	$("#login").click(function() {
		$("#formulario").attr("action","base_de_datos/login.php");
		$(".modal,.fade").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#estado").val("Iniciar Sesion");
		$("#ocultar").hide();

		 // $("#passwordLogin").val('');

		  $("#passwordLogin").show();
		  $("#password").hide();
		  $("#password").attr('required', false);
		  $("#passwordLogin").attr('required', true);
		  $("#resultado").hide();//testear posible error de campo requerido?


	});




	$("#registro").click(function() {
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
	

	
	$("#estado").click(function(e) {
		if ($("#password").val()===$("#passwordR").val()){
			console.log("bien");
		}
		else{
			$("#incompleto").text('Error los password no coinciden');
			e.preventDefault();

		}
	});

	});

	$("#password,#passwordR,#passwordLogin").on('input', function(e) {
		if (!/^[ a-zA-Z0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
	};
	});

	
	$('.modal ,.fade').on('hidden.bs.modal', function (e) {
		$("#mail").val("");
		$("#passwordR").val("");
		$("#password").val("");
		$("#password").attr('class', '');
		$("#passwordR").attr('class', '');
		$("#incompleto").text('');
		$(".modal,.fade").attr('id','');
		$(".imagenchica").attr('src', '');
		$("#formulario").attr("action","");
		$("#resultado").html("");

	});

	$('#mail').blur(function(event) {
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
                        }
                        else{
                        	if(correo==""){
                        		$("#resultado").html("por favor complete el campo mail");
                        	}
                        	else{
                        	$("#resultado").html("ok");
                        }
                        }
                }
        });
	});

});

