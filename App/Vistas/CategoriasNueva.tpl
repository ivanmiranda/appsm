<incluir archivo="Header">
<incluir archivo="Menu">
<div class="container">
	<header class="major">
		<h2>Categorías</h2>
	</header>
	<fieldset>
		<legend>Agregar</legend>
		<form id="frmCategorias">
			<input type="text" class="form-control col-lg-8" placeholder="nombre/razon social" name="razonSocial"><label id="lblNombre" class="label label-danger"></label><br><br>
			<input type="text" class="form-control col-lg-8" placeholder="RFC" name="rfc"><label id="lblRFC" class="label label-danger"></label><br><br>
			<input type="text" class="form-control col-lg-8" placeholder="correo" name="correo"><label id="lblCorreo" class="label label-danger"></label><br><br>
			<button type="button" class="btn btn-success" onclick="guardaCliente($('#frmCategorias').serializeJSON())">guardar</button>
		</form>
	</fieldset>
</div>
<script type="text/javascript">
function guardaCliente(datos){
	if(sincco.esVacio(datos.razonSocial)) {
		$("#lblNombre").html("Este campo es necesario")
		//return false
	} else {
		$("#lblNombre").html("")
	}
	if(sincco.validarRFC(datos.rfc)) {
		$("#lblRFC").html("")
	} else {
		$("#lblRFC").html("Captura un RFC valido (XAXX010101000 para generico)")
		return false
	}
	if(sincco.validarCorreo(datos.correo)) {
		$("#lblCorreo").html("")
	} else {
		$("#lblCorreo").html("Captura un correo valido")
		//return false
	}
	sincco.consumirAPI("POST","{BASE_API}publico/clientes",datos)
	.done(function(data) {
		if(data.respuesta > 0){
			window.location = "{BASE_URL}/clientes"
		}
		//console.log(data)
	}).fail(function(jqXHR, textStatus, errorThrown) {
		console.log(errorThrown)
	})
}
</script>
<incluir archivo="Footer">