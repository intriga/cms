<?php 

require_once 'conexion.php';

class SuscriptoresModel{

	#mostrar suscriptores en la vista
	#----------------------------------------------
	public function mostrarSuscriptoresModel($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, email FROM $tabla");
		$stmt->execute();
	    return $stmt->fetchAll();
	    $stmt->close();
	}

	#borrar  suscriptores en la vista
	#----------------------------------------------
	public function borrarSuscriptoresModel($datosModel, $tabla){
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

	#suscriptores sin revisar
	#----------------------------------------------
	public function suscriptoresSinRevisarModel($tabla){
   		$stmt = Conexion::conectar()->prepare("SELECT revision FROM $tabla");
		$stmt->execute();
	    return $stmt->fetchAll();
	    $stmt->close();
   	}

   	#suscriptores REVISADOS
   	#---------------------------------------------------
   	public function suscriptoresRevisadosModel($datosModel, $tabla){
   		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision");	    
	    $stmt -> bindParam(":revision", $datosModel, PDO::PARAM_INT);
	    if ($stmt->execute()) {
	      return "ok";
	    }
	    else {
	      "error";
	    }
	    $stmt->close();
   	}
	
}

