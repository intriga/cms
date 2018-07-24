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
PERFIL
======================================-->

<div id="editarPerfil" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

  <h1>Hola <?php echo $_SESSION["usuario"] ?>
  <span class="btn btn-info fa fa-pencil pull-left" style="font-size:10px; margin-right:10px"></span></h1>

  <div style="position:relative">
  <img src="views/images/photo.jpg" class="img-circle pull-right">
  
  </div>

  <hr>

  <h4>Perfil: Administrador</h4>

  <h4>Email: correo@correo.com</h4>

  <h4>Contraseña: *******</ph4>

  </div>

  <div id="crearPerfil" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">



  <button id="registrarPerfil" class="btn btn-default" style="margin-bottom: 20px">Registrar un nuevo usuario</button>

  <form id="formularioPerfil" method="post" enctype="multipart/form-data" style="display: none;">
    
    <div class="form-group">
      <input name="nuevoUsuario" type="text" placeholder="Ingrese el nombre de usuario" maxlength="10" class="form-control" required>
    </div>

    <div class="form-group">
      <input name="nuevoPassword" type="password" placeholder="Ingrese la contraseña" maxlength="10" class="form-control" required>
    </div>

    <div class="form-group">
      <input name="nuevoEmail" type="email" placeholder="Ingrese el correo electronico" class="form-control" required>
    </div>

    <div class="form-group">
      <select name="nuevoRol" class="form-control" required>
        <option value="">Seleccione el Rol</option>
        <option value="0">Administrador</option>
        <option value="1">Editor</option>
      </select>
    </div>

    <div class="form-group text-center">
      <input type="file" class="btn btn-default" id="subirFotoPerfil" style="display: inline-block; margin: 10px 0">
        <p class="text-center" style="font-size: 12px">Tamaño recomendado de la imagen: 100px * 100px, peso minimo 2MB</p>
      </input>
    </div>

    <input type="submit" id="guardarPerfil" value="Guardar Perfil" class="btn btn-primary">

  </form>

  <?php 

    $crearPerfil = new GestorPerfiles();
    $crearPerfil -> guardarPerfilController();

   ?>

  <hr>

  <div class="table-responsive">

  <table id="tablaSuscriptores" class="table table-striped display">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Perfil</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><span class="btn btn-info fa fa-pencil quitarSuscriptor"></span>
          <span class="btn btn-danger fa fa-times"></span></td>
      </tr>
      
    </tbody>
  </table>

  </div>
  </div>

<!--====  Fin de PERFIL  ====-->
