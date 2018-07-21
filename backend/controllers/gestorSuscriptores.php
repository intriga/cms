<?php 

class SuscriptoresController{

	#mostrar suscriptores en la vista
	#----------------------------------------------
	public function mostrarSuscriptoresController(){
		$respuesta = SuscriptoresModel::mostrarSuscriptoresModel("suscriptores");
		foreach ($respuesta as $row => $item) {
			echo '<tr>
		        <td>'.$item["nombre"].'</td>
		        <td>'.$item["email"].'</td>
		        <td>
		        <a href="index.php?action=suscriptores&idBorrar='.$item["id"].'"><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a>
		        </td>    
		        <td>
		        </td>
		      </tr>';
		}
	}

	#borrar  suscriptores en la vista
	#----------------------------------------------
	public function borrarSuscriptoresController(){

		if (isset($_GET["idBorrar"])) {
			$datosController = $_GET["idBorrar"];
			$respuesta = SuscriptoresModel::borrarSuscriptoresModel($datosController, "suscriptores");

			if ($respuesta == "ok") {
	        echo '<script>
	                swal({
	                  title: "¡OK!",
	                  text: "¡El suscripto se ha borrado correctamente!",
	                  type: "success",
	                  confirmButtonText: "Cerrar",
	                  closeOnConfirm: false
	                },
	                function(isConfirm){
	                  if (isConfirm) {
	                    window.location = "suscriptores";
	                  }
	                });
	              </script>';
	      }
		}
	}

	#impresion suscriptores 
	#----------------------------------------------
	public function ImpresionSuscriptoresController($datos){
		$datosController = $datos;
		$respuesta = SuscriptoresModel::mostrarSuscriptoresModel($datosController);
		return $respuesta;
	}
}