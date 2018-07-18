//mostrar mensajes
$(".leermensaje").click(function() {
	
	id = $(this).parent().attr('id');
	//console.log('id',id)
	fecha = $('#'+id).children("p").html();
	nombre = $('#'+id).children("h3").html();
	email = $('#'+id).children("h5").html();
	mensaje = $('#'+id).children("input").val();

	$("#visorMensaje").html('<div class="well well-sm">' +    
    '<h3>De: '+nombre+'</h3>' +
    '<h5>Email: '+email+'</h5>' +
      '<p style="background:#fff; padding:10px">'+mensaje+'</p>' +
      '<button class="btn btn-info btn-sm responderMensaje">Responder</button>' +
    '</div>' );

    $(".responderMensaje").click(function() {
    	enviarEmail = $(this).parent().children('h5').html();
    	enviarNombre = $(this).parent().children('h3').html();

		$("#visorMensaje").html('<form method="post">' +

								  '<p><input type="email" value="'+enviarEmail.slice(6)+'" name="enviarEmail" readOnly style="border:0px">' +

								  '<input type="hidden" value="'+enviarNombre.slice(4)+'" name="enviarNombre"></p>' +

							      //'<p>Para: '+enviarNombre.slice(6)+' <br> '+enviarNombre.slice(4)+'</p>' +

							      '<input type="text" name="enviarTitulo" placeholder="Título del Mensaje" class="form-control">' +

							      '<textarea name="enviarMensaje" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea>' +

							      '<input type="submit" class="form-control btn btn-primary" value="Enviar">' +

							    '</form>');
    });

});