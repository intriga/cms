//registro perfil
$("#registrarPerfil").click(function() {
	$("#formularioPerfil").toggle("fast");
});

$("#subirFotoPerfil").change(function() {
	$("#subirFotoPerfil").attr("name","nuevaImagen");
});