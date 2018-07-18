<?php 

require_once 'backend/models/conexion.php';

class MensajesModel{

	#registro mensaes
	#-------------------------------
	public function registroMensajesModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);
		if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();

	}

	#registro suscriptores
	#-------------------------------
	public function registroSuscriptorModel($datos, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email) VALUES (:nombre, :email)");
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();
	}

	#registro suscriptores existentes
	#------------------------------------
	public function revisarSuscriptorModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT email FROM $tabla WHERE email = :email");
		$stmt -> bindParam(":email", $datosModel, PDO::PARAM_STR);
		$stmt->execute();
	    return $stmt->fetch();
	    $stmt->close();
	}
}