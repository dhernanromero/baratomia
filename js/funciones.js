$(document).ready(function() {
	$("#login").click(function() {
		$("#formregistro").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#estado").val("Iniciar Sesion");
		$("#ocultar").hide();
	});
	$("#registro").click(function() {
		$("#formlogin").attr('id','formregistro');
		$("#exampleModalLabel").text("Registrate");
		$("#ocultar").show();
		$("#estado").val("Registro");
	});

	$("#password,#passwordR").on('input', function(e) {
		if (!/^[ a-zA-Z0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
	};
	});

	$("#passwordR").on("input",function(e){ 

		if ($("#password").val()===$("#passwordR").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			
		}
		});
	$("#password").on("input",function(e){ 

		if ($("#password").val()===$("#passwordR").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			
		}
		});


	
	$("#estado").click(function() {
		if ($("#password").val()===$("#passwordR").val()){
			console.log("bien");
		}
		else{
			console.log("mal");
		}
	});

	


});
