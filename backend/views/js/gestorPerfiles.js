//registro perfil
$("#registrarPerfil").click(function() {
	$("#formularioPerfil").toggle("fast");
});

$("#subirFotoPerfil").change(function() {
	$("#subirFotoPerfil").attr("name","nuevoImagen");
});

//mostrar fomulario editar perfil
$("#btnEditarPerfil").click(function() {
	$("#editarPerfil").hide("fast");
	$("#formEditarPerfil").show("fast");
});

$("#cambiarFotoPerfil").change(function() {
	$("#cambiarFotoPerfil").attr("name","editarImagen");
})