// Area de arrastre de imagenes

if ($("#lightbox").html() == 0) {
  $("#lightbox").css({"height":"100px"});
}
else{
  $("#lightbox").css({"height":"auto"});
}

//subir multiples imagenes
$("body").on("dragover",function(e) {
	e.preventDefault();
	e.stopPropagation();
});

$("#lightbox").on("dragover",function(e) {
	e.preventDefault();
	e.stopPropagation();

	$("#lightbox").css({"background":"url(views/images/pattern.jpg)"});
});

//soltar imagenes
$("body").on("drop",function(e) {
	e.preventDefault();
	e.stopPropagation();
});

var imagenSize = new Array();
var imagenType = new Array();

$("#lightbox").on("drop", function(e) {
	e.preventDefault();
	e.stopPropagation();

	$("#lightbox").css({"background":"white"});

	archivo = e.originalEvent.dataTransfer.files;
	for (var i = 0; i < archivo.length; i++) {
		imagen = archivo[i];
		imagenSize.push(imagen.size);
		//console.log("imagenSize",imagenSize);
		imagenType.push(imagen.type);
		//console.log("imagenType",imagenType);
		
		if (Number(imagenSize[i]) > 2000000) {
		    $("#lightbox").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido 200 mb</div>');
		  }
		  else{
		    $(".alerta").remove();
		  }

		  if (imagenType[i] == "image/jpeg" || imagenType[i] == "image/jpg" || imagenType[i] == "image/png") {
		    $(".alerta").remove();
		  }
		  else{
		    $("#lightbox").before('<div class="alert alert-warning alerta text-center">El archivo debe ser JPG o PNG</div>');
		  }

		  if (Number(imagenSize[i]) < 2000000 && imagenType[i] == "image/jpeg" || imagenType[i] == "image/jpg" || imagenType[i] == "image/png") {

		  	var datos = new FormData();
    		datos.append('imagen', imagen);

    		$.ajax({
    			url: "views/ajax/gestorGaleria.php",
			    method: "POST",
			    data: datos,
			    cache: false,
			    contentType: false,
			    processData: false,
			    beforeSend: function(){
			    	$("#lightbox").append('<li id="status"><img src="views/images/status.gif" id="status"><li>');
			    },
			    success: function(respuesta){
			    	$("#status").remove();
			    	if (respuesta == 0) {
			          $("#lightbox").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1024px * 768px</div>');
			        }
			        else{
			          $("#lightbox").css({"height":"auto"});
			          $("#lightbox").append('<li>' +
										      '<span class="fa fa-times"></span>' +
										      '<a rel="grupo" href="'+respuesta.slice(6)+'">' +
										      '<img src="'+respuesta.slice(6)+'">' +
										      '</a>' +
										    '</li>');
			        
			        swal({
			              title: "¡OK!",
			              text: "¡La imagen se subio correctamente!",
			              type: "success",
			              confirmButtonText: "Cerrar",
			              closeOnConfirm: false
			            },
			            function(isConfirm){
			              if (isConfirm) {
			                window.location = "galeria";
			              }
			            });
			        }
			    		    	
			    }
    		});

		  }

	}
});

//eliminar item de la galeria
$(".eliminarFoto").click(function() {

	if($("#lightbox").html() == 0){
		$("#lightbox").css({"height":"100px"});
	}

	idGaleria = $(this).parent().attr("id");
	rutaGaleria = $(this).attr("ruta");
	//console.log('idGaleria', idGaleria);
	$(this).parent().remove();

	var borrarItem = new FormData();
	borrarItem.append('idGaleria', idGaleria);
	borrarItem.append('rutaGaleria', rutaGaleria);

	$.ajax({
		url: "views/ajax/gestorGaleria.php",
	    method: "POST",
	    data: borrarItem,
	    cache: false,
	    contentType: false,
	    processData: false,
	    success: function(respuesta){
	    	console.log('respuesta',respuesta)
	    }
	});
});

//ordenar galeria 
var almacenarOrdenId = new Array();
var ordenItem = new Array();

$("#ordenarGaleria").click(function() {
	$("#ordenarGaleria").hide();
	$("#guardarGaleria").show();

	$("#lightbox").css({"cursor":"move"});
	$("#lightbox span").hide();

	$("#lightbox").sortable({
		revert: true,
	    connectWith: ".bloqueGaleria",
	    handle: ".handleImg",
	    stop:function(event){
	      for (var i = 0; i < $("#lightbox li").length; i++) {
	        almacenarOrdenId[i] = event.target.children[i].id;
	        ordenItem[i] = i+1;
	      }
	    }
	});

	$("#guardarGaleria").click(function() {
		$("#guardarGaleria").hide();
		$("#ordenarGaleria").show();

		for (var i = 0; i < $("#lightbox li").length; i++) {
		  var actualizarOrden = new FormData();
	      actualizarOrden.append('actualizarOrdenGaleria', almacenarOrdenId[i]);
	      actualizarOrden.append('actualizarOrdenItem', ordenItem[i]);

	      $.ajax({
	      	url: "views/ajax/gestorGaleria.php",
	        method: "POST",
	        data: actualizarOrden,
	        cache: false,
	        contentType: false,
	        processData: false,
	        success: function(respuesta){
	        	$("#lightbox").html(respuesta);

	        	swal({
	              title: "¡OK!",
	              text: "¡El orden se ha actualizados correctamente!",
	              type: "success",
	              confirmButtonText: "Cerrar",
	              closeOnConfirm: false
	            },
	            function(isConfirm){
	              if (isConfirm) {
	                window.location = "galeria";
	              }
	            });
	        }

	      });
		}
	})
})