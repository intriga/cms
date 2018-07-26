<?php

require_once '../../controllers/gestorMensajes.php';
require_once '../../models/gestorMensajes.php';

require_once '../../controllers/gestorSuscriptores.php';
require_once '../../models/gestorSuscriptores.php';

#CLASE Y METODOS
#---------------------------------
class Ajax{

	#REVISAR MENSAJES
	#---------------------------------
	public $revisionMensajes;

	public function gestorRevisionMensajesAjax(){
		$datos = $this->revisionMensajes;
	    $respuesta = MensajesController::mensajesRevisadosController($datos);
	    echo $respuesta;
	}

	#REVISAR SUSCRIPTORES
	#---------------------------------
	public $revisionSuscriptores;

	public function gestorRevisionSuscriptoresAjax(){
		$datos = $this->revisionSuscriptores;
	    $respuesta = SuscriptoresController::suscriptoresRevisadosController($datos);
	    echo $respuesta;
	}

}

#OBJETOS
#---------------------------------
if (isset($_POST["revisionMensajes"])) {
	$a = new Ajax();
	$a -> revisionMensajes = $_POST["revisionMensajes"];
	$a -> gestorRevisionMensajesAjax();
}

if (isset($_POST["revisionSuscriptores"])) {
	$a = new Ajax();
	$a -> revisionSuscriptores = $_POST["revisionSuscriptores"];
	$a -> gestorRevisionSuscriptoresAjax();
}