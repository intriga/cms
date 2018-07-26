<?php 

require_once 'conexion.php';

class GestorPerfilesModel{

	public function guardarPerfilModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email, photo, rol ) VALUES (:usuario, :password, :email, :photo, :rol)");
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

	#visualizar PERFIL
	#--------------------------
	public function verPerfilesModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email, photo, rol FROM $tabla");
	    $stmt->execute();
	    return $stmt->fetchAll();
	    $stmt->close();
	}

	#EDITAR PERFIL
	#--------------------------
	public function editarPerfilesModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email, photo = :photo, rol = :rol WHERE id = :id");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
	    $stmt -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
	    $stmt -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
	    $stmt -> bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
	    $stmt -> bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
	    $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

	    if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();

	}

	#borrar PERFIL
	#--------------------------
	public function borrarPerfilModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
	    $stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);
	    if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();
	}
}