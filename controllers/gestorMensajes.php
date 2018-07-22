<?php 

class MensajesController{

	public function registroMensajesController(){
		
		if (isset($_POST["nombre"])) {
			if(preg_match('/^[a-zA-Z\s]+$/', $_POST["nombre"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["email"]) &&
			   preg_match('/^[a-zA-Z0-9\s\.,]+$/', $_POST["mensaje"])){

			   	
			   	#enviar correo electronico
			   	#---------------------------------------------------
			   	$correoDestino = "intriga@plusultraviajes.com";
			    $asunto = "mensajes de prueba";
			    $mensaje = "Nombre: ".$_POST["nombre"]."\n"."\n".
			    			"Email: ".$_POST["email"]."\n"."\n".
			    			"Mensaje: ".$_POST["mensaje"];
			    $cabezera = "FROM: Sitio web" ."\r\n". 
			    "CC: ".$_POST["email"];
			   	$envio = mail($correoDestino, $asunto, $mensaje, $cabezera);

			   	$datosController = array('nombre' => $_POST["nombre"], 
			   							 'email' => $_POST["email"],
			   							 'mensaje' => $_POST["mensaje"]);

			   	#almacenar en base de datos el suscriptor
			   	#---------------------------------------------------
			   	$datosSuscriptor = $_POST["email"];
			   	$revisarSuscriptor = MensajesModel::revisarSuscriptorModel($datosSuscriptor, "suscriptores");
			   	
			   	//si suscriptor email no existe
			   	if (count($revisarSuscriptor["email"]) == 0) {
			   		MensajesModel::registroSuscriptorModel($datosController, "suscriptores");
			   	}

			   	
			   	
				#almacenar en base de datos el mensaje
			   	#---------------------------------------------------
			   	$datosController = array('nombre' => $_POST["nombre"], 
			   							 'email' => $_POST["email"],
			   							 'mensaje' => $_POST["mensaje"]);

			   $respuesta = MensajesModel::registroMensajesModel($datosController, "mensajes");

			   if (/*$envio == true &&*/ $respuesta == "ok") {
			   	echo '<script>
		                swal({
		                  title: "¡OK!",
		                  text: "¡El mensaje se ha enviado correctamente!",
		                  type: "success",
		                  confirmButtonText: "Cerrar",
		                  closeOnConfirm: false
		                },
		                function(isConfirm){
		                  if (isConfirm) {
		                    window.location = "index.php";
		                  }
		                });
		              </script>';
			   }
				
				
			}
			else{
				echo '<div class="alert alert-danger">No se permiter caracteres especiales.</div>';
			}

		}
	}

	
}