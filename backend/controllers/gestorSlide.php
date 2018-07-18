<?php

class GestorSlide{

  #MOSTRAR IMAGEN DEL slide
  #-------------------------------------
  public function mostrarImagenController($datos){

    list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);

    if ($ancho < 1600 || $alto < 600) {
      echo 0;
    }
    else{
      $aleatorio = mt_rand(100, 999);
      $ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

      $origen = imagecreatefromjpeg($datos["imagenTemporal"]);

      $destino = imagecrop($origen,["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);

      imagejpeg($destino, $ruta);

      GestorSlideModel::subirImagenSlideModel($ruta, "slide");

      $respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");
      $enviarDatos = array('ruta' => $respuesta["ruta"],
                           'titulo' => $respuesta["titulo"],
                           'descripcion' => $respuesta["descripcion"]);
      echo json_encode($enviarDatos);
    }

  }

  #MOSTRAR IMAGENES  EN LA VISTA
  #-------------------------------------
  public function mostrarImagenVistaController() {

    $respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");
    foreach ($respuesta as $fila => $item) {
      echo '<li id="'.$item["id"].'" class="bloqueSlide">
              <span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span>
              <img src="'.substr($item["ruta"],6).'" class="handleImg">
            </li>';
    }
  }

  #MOSTRAR IMAGENES  EN EL EDITOR
  #-------------------------------------
  public function editorSlideController(){
    $respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");
    foreach ($respuesta as $fila => $item) {
    echo '<li id="item'.$item["id"].'">
            <span class="fa fa-pencil editarSlide" style="background:blue"></span>
            <img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%">
            <h1>'.$item["titulo"].'</h1>
            <p>'.$item["descripcion"].'</p>
          </li>';
    }
  }

  #ELIMINAR ITEM DEL SLIDE
  #-------------------------------------
  public function eliminarSlideController($datos){
    $respuesta = GestorSlideModel::eliminarSlideModel($datos, "slide");
    unlink($datos["rutaSlide"]);
    echo $respuesta;
  }

  #ACTUALIZAR ITEM SLIDE
  #---------------------------------
  public function actualizarSlideController($datos){

    GestorSlideModel::actualizarSlideModel($datos, "slide");
    $respuesta = GestorSlideModel::seleccionarActualizacionSlideModel($datos, "slide");
    $enviarDatos = array('titulo' => $respuesta["titulo"],
                          'descripcion' => $respuesta["descripcion"]);
    echo json_encode($enviarDatos);
  }

  #ACTUALIZAR ORDEN
  #---------------------------------
  public function actualizarOrdenController($datos){
    GestorSlideModel::actualizarOrdenModel($datos, "slide");
    $respuesta = GestorSlideModel::seleccionarOrdenModel("slide");

    foreach ($respuesta as $row => $item) {
      echo '<li id="item'.$item["id"].'">
              <span class="fa fa-pencil editarSlide" style="background:blue"></span>
              <img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%">
              <h1>'.$item["titulo"].'</h1>
              <p>'.$item["descripcion"].'</p>
            </li>';
    }

  }

  public function seleccionarSlideController(){

    $respuesta = GestorSlideModel::seleccionarSlideModel("slide");
    foreach ($respuesta as $row => $item) {
      echo '<li>
         <img src="'.substr($item["ruta"],6).'">
           <div class="slideCaption">
             <h3>'.$item["titulo"].'</h3>
             <p>'.$item["descripcion"].'</p>
           </div>
        </li>';
    }

  }
}
