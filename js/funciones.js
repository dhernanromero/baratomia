$(document).ready(function() {
	$("#login").click(function() {
		$("#formregistro").attr('id','formlogin');
		$("#exampleModalLabel").text("Logueate");
		$("#ocultar").hide();
	});
	$("#registro").click(function() {
		$("#formlogin").attr('id','formregistro');
		$("#exampleModalLabel").text("Registrate");
		$("#ocultar").show();
	});

	$("#password,#passwordR").on('input', function(e) {
		if (!/^[ a-zA-Z0-9]*$/i.test(this.value)) {
        this.value = this.value.replace(/[^ a-z0-9áéíóúüñ]+/ig,"");
	};
	});

});
