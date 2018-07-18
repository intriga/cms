<?php

session_start();
if (!$_SESSION["validar"]) {
  header("location:ingreso");
  exit();
}

include 'views/modules/botonera.php';
include 'views/modules/cabezote.php';

 ?>
<!--=====================================
VIDEOS ADMINISTRABLE
======================================-->

<div id="videos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

<form method="post" enctype="multipart/form-data">

    <input type="file" id="subirVideo" name="video" class="btn btn-default" required>

  </form>
  <p>Solo subir videos en formato mp4 y que no exceda los 50mb</p>

  <ul id="galeriaVideo">
    
    <?php 

      $video = new GestorVideos();
      $video -> mostrarVideoVistaController();

     ?>

  </ul>


    <button id="ordenarVideo" class="btn btn-warning " style="margin:10px 30px;">Ordenar Videos</button>
    <button id="guardarVideo" class="btn btn-primary " style="margin:10px 30px; display: none;">Guardar Orden Videos</button>

  </div>


<!--====  Fin de VIDEOS ADMINISTRABLE  ====-->
<!-- <li>
      <span class="fa fa-times"></span>
      <video controls>
            <source src="views/videos/video01.mp4" type="video/mp4">
          </video>
    </li>

    <li>
      <span class="fa fa-times"></span>
      <video controls>
            <source src="views/videos/video02.mp4" type="video/mp4">
          </video>
    </li>

    <li>
      <span class="fa fa-times"></span>
      <video controls>
            <source src="views/videos/video03.mp4" type="video/mp4">
          </video>
    </li>

    <li>
      <span class="fa fa-times"></span>
      <video controls>
            <source src="views/videos/video04.mp4" type="video/mp4">
          </video>
    </li> -->