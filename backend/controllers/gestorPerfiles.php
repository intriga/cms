<?php 

class GestorPerfiles{

	#GUARDAR PERFIL
	#--------------------------
	public function guardarPerfilController(){

		$ruta = "";
		
		if (isset($_POST["nuevoUsuario"])) {

			if (isset($_FILES["nuevoImagen"]["tmp_name"])) {
				$imagen = $_FILES["nuevoImagen"]["tmp_name"];
				$aleatorio = mt_rand(100, 999);
				$ruta = "views/images/perfiles/perfil".$aleatorio."jpg";
				$origen = imagecreatefromjpeg($imagen);
				$destino = imagecrop($origen,["x"=>0, "y"=>0, "width"=>100, "height"=>100]);
				imagejpeg($destino, $ruta);
			}

			if ($ruta = "") {
				$ruta = "views/images/photo.jpg";
			}

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"])&&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"])){

			   $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');

				$datosController = array('usuario' => $_POST["nuevoUsuario"], 
										 'password' => $encriptar,
										 'email' => $_POST["nuevoEmail"],
										 'rol' => $_POST["nuevoRol"],
										 'photo' => $ruta);

				$respuesta = GestorPerfilesModel::guardarPerfilModel($datosController, "usuarios");

				if ($respuesta == "ok") {
			        echo '<script>
			                swal({
			                  title: "¡OK!",
			                  text: "¡El usuario se ha creado correctamente!",
			                  type: "success",
			                  confirmButtonText: "Cerrar",
			                  closeOnConfirm: false
			                },
			                function(isConfirm){
			                  if (isConfirm) {
			                    window.location = "perfil";
			                  }
			                });
			              </script>';
			      }

			}
			else{
				echo '<div class="alert alert-warning"><b>¡ERROR!</b> No ingrese caracteres especiales</div>';
			}
			
		}
	}
}