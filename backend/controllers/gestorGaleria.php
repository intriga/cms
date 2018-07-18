<?php  

class GestorGaleria{

	#MOSTRAR IMAGEN GALERIA AJAX
	#--------------------------------
	public function mostrarImagenController($datos){

		list($ancho, $alto) = getimagesize($datos);
		if ($ancho < 1024 || $alto < 768) {
	      echo 0;
	    }
	    else{
	      $aleatorio = mt_rand(100, 999);
	      $ruta = "../../views/images/galeria/galeria".$aleatorio.".jpg";
	      $nuevo_ancho = 1024;
	      $nuevo_alto = 768;
	      $origen = imagecreatefromjpeg($datos);

	      #imagencreatetruecolor - crear una nueva imagen de color verdadero
	      $destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

	      #imagecopyresized() - copia una porcion de una imagen a otra imagen 	      
	      imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

	      imagejpeg($destino, $ruta);

	      GestorGaleriaModel::subirImagenGaleriaModel($ruta, "galeria");

	      $respuesta = GestorGaleriaModel::mostrarImagenGaleriaModel($ruta, "galeria");
	      echo $respuesta["ruta"];
	    }
	}

	#SMOSTRAR IMAGEN EN LA VISTA
	#--------------------------------
	public function mostrarImagenVistaController(){
		
		$respuesta = GestorGaleriaModel::mostrarImagenVistaModel("galeria");
		foreach ($respuesta as $row => $item) {
			echo '<li id="'.$item["id"].'" class="bloqueGaleria">
				      <span class="fa fa-times eliminarFoto" ruta="'.$item["ruta"].'"></span>
				      <a rel="grupo" href="'.substr($item["ruta"],6).'">
				      <img src="'.substr($item["ruta"],6).'" class="handleImg">
				      </a>
				    </li>';
		}
	}

	#ELIMINAR ITEM GALERIA
	#---------------------------------
	public function eliminarGaleriaController($datos){
		
		$respuesta = GestorGaleriaModel::eliminarGaleriaModel($datos, "galeria");
		unlink($datos["rutaGaleria"]);
	    echo $respuesta;
	}

	#ACTUALIZAR ORDEN
  	#---------------------------------
  	public function actualizarOrdenController($datos){

	    GestorGaleriaModel::actualizarOrdenModel($datos, "galeria");
	    $respuesta = GestorGaleriaModel::seleccionarOrdenModel("galeria");

	    foreach ($respuesta as $row => $item) {
			echo '<li id="'.$item["id"].'" class="bloqueGaleria">
				      <span class="fa fa-times eliminarFoto ruta="'.$item["ruta"].'"></span>
				      <a rel="grupo" href="'.substr($item["ruta"],6).'">
				      <img src="'.substr($item["ruta"],6).'" class="handleImg">
				      </a>
				    </li>';
		}

	}
}