<?php 

require_once 'conexion.php';

class GestorPerfilesModel{
	public function guardarPerfilModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, email, photo, rol ) VALUES (:usuario, :password, :email, :photo, :rol)");
		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
	    $stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
	    $stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
	    $stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
	    $stmt -> bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
	    if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();
	}
}