<?php 

class MensajesController{

	#mostrar mensajes en la vista
	#------------------------------------
	public function mostrarMensajesController(){
		
		$respuesta = MensajesModel::mostrarMensajesModel("mensajes");
		foreach ($respuesta as $row => $item) {
			echo '<div class="well well-sm" id="'.$item["id"].'">

				    	<a href="index.php?action=mensajes&idBorrar='.$item["id"].'"><span class="fa fa-times pull-right"></span></a>
				    	<p>'.$item["fecha"].'</p>
				    	<h3>'.$item["nombre"].'</h3>
				    	<h5>'.$item["email"].'</h5>
				    	<input type="text" class="form-control" value="'.$item["mensaje"].'" readonly>	
				    	<br>			      	
				      	<button class="btn btn-info btn-sm leermensaje">Leer</button>

				    </div>';
		}
	}

	#borrar mensajes 
	#------------------------------------
	public function borrarMensajesController(){
		
		if (isset($_GET["idBorrar"])) {
			$datosController = $_GET["idBorrar"];

			$respuesta = MensajesModel::borrarMensajesModel($datosController, "mensajes");
			if ($respuesta == "ok") {
	        echo '<script>
	                swal({
	                  title: "¡OK!",
	                  text: "¡El mensaje se ha borrado correctamente!",
	                  type: "success",
	                  confirmButtonText: "Cerrar",
	                  closeOnConfirm: false
	                },
	                function(isConfirm){
	                  if (isConfirm) {
	                    window.location = "mensajes";
	                  }
	                });
	              </script>';
	      }
		}
	}

	#responder mensajes 
	#------------------------------------
	public function responderMensajesController(){
		
		if (isset($_POST["enviarEmail"])) {
			
			$email = $_POST["enviarEmail"];
			$nombre = $_POST["enviarNombre"];
			$titulo = $_POST["enviarTitulo"];
			$mensaje = $_POST["enviarMensaje"];

			$para = $email . ', ';
			$para .= "intriga@plusultraviajes.com";

			$título = 'Recordatorio de cumpleaños para Agosto';

			$mensaje = '<html>
						<head>
						  <title>Recordatorio de cumpleaños para Agosto</title>
						</head>
						<body>

						<h1>hola '.$nombre.'</h1>
						<p>'.$mensaje.'</p>
						<p>intriga fsociety</p>
						<p>number: 000.00.00.</p>
						<br>

						<a href="#"><img src="http://sites.psu.edu/lby5015engl15a001/wp-content/uploads/sites/9209/2014/02/books.jpg"></a>				
						
						</body>
						</html>';

			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

			$cabeceras .= 'From: Recordatorio <intriga@plusultraviajes.com>' . "\r\n";

			$envio = mail($para, $título, $mensaje, $cabeceras);

			if ($envio) {
				 echo '<script>
		                swal({
		                  title: "¡OK!",
		                  text: "¡El mensaje se ha borrado correctamente!",
		                  type: "success",
		                  confirmButtonText: "Cerrar",
		                  closeOnConfirm: false
		                },
		                function(isConfirm){
		                  if (isConfirm) {
		                    window.location = "mensajes";
		                  }
		                });
		              </script>';
			}
		}
	}
}