$(document).ready(function() {
	$("#login").click(function() {
		$(".modal,.fade").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#estado").val("Iniciar Sesion");
		$("#ocultar").hide();

	});
	$("#registro").click(function() {
		$(".modal,.fade").attr('id','formregistro');
		$("#exampleModalLabel").text("Registrate");
		$("#ocultar").show();
		$("#estado").val("Registro");
		
		$("#passwordR").on("input",function(e){ 

		if ($("#password").val()===$("#passwordR").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
			$(".imagenchica").attr('src', 'imagenes/ok.png');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			$(".imagenchica").attr('src', 'imagenes/error.png');
			
		}
		});

		$("#password").on("input",function(e){ 

		if ($("#passwordR").val()===$("#password").val()){
			$("#passwordR").attr('class', 'ok');
			$("#password").attr('class', 'ok');
			$(".imagenchica").attr('src', 'imagenes/ok.png');
		}

		else
		{
			$("#passwordR").attr('class', 'error');
			$("#password").attr('class', 'error');
			$(".imagenchica").attr('src', 'imagenes/error.png');
			
		}
		});
	

	
	$("#estado").click(function(e) {
		if ($("#password").val()===$("#passwordR").val()){
			console.log("bien");
		}
		else{
			$("#incompleto").text('error los password no coinciden');
			e.preventDefault();

		}
	});

	});

	$("#password,#passwordR").on('input', function(e) {
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
	});

	


});
