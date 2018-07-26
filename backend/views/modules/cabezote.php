<!--=====================================
 CABEZOTE
======================================-->


<div id="cabezote" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

    <ul>
      <li  style="background: #333">
        <a href="mensajes" style="color: #fff">
                  <i class="fa fa-envelope"></i>
                  <?php 
                    $revisarMensajes = new MensajesController();
                    $revisarMensajes -> mensajesSinRevisarController();
                   ?>
                </a>
      </li>

      <li  style="background: #333">
        <a href="suscriptores" style="color: #fff">
                  <i class="fa fa-bell"></i>
                  <?php 
                    $revisarMensajes = new SuscriptoresController();
                    $revisarMensajes -> suscriptoresSinRevisarController();
                   ?>
                </a>
      </li>

    </ul>

  </div>

  <div id="time" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">


    <div class="text-center">
      <?php 
       

        echo date("l").", ",date("d")." de ".date("F")." de ".date("Y");
        
       ?>
    </div>

    <div class="text-center">
      <?php 
       
        date_default_timezone_set("America/Caracas");

        echo '<div id="hora" hora="'.date("h").'" minutos="'.date("i").'" segundos="'.date("s").'" meridiano="'.date("a").'"></div>'
        
       ?>
    </div>

  </div>

  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-right">

    <img src="<?php echo $_SESSION["photo"]; ?>" class="img-circle">

    <p id="member"><?php echo $_SESSION["usuario"]; ?><span class="fa fa-chevron-down"></span>
      <br>
      <ol id="admin">
        <li><a href="perfil"><span class="fa fa-user"></span>Editar Perfil</a></li>
        <li><a href="terminos.pdf"><span class="fa fa-file-text"></span>Términos y Condiciones</a></li>
        <li><a href="salir"><span class="fa fa-times"></span>Salir</a></li>
      </ol>

    </p>

  </div>

</div>

<!--====  Fin de CABEZOTE  ====-->

<script>
  //reloj dinamico
  function reloj() {

    hora = $("#hora").attr("hora");
    minutos = $("#hora").attr("minutos");
    segundos = $("#hora").attr("segundos");
    meridiano = $("#hora").attr("meridiano");
    
    setInterval(function(){

      if (segundos > 58) {
        segundos = "0" + 0;
        minutos = Number(minutos) + 1;
      }
      else{
        segundos++;
        if (segundos > 0 && segundos < 10) {
          segundos = "0" + segundos++;
        }
      }

      if (minutos > 59) {
        window.location.reload();
      }
      

      $("#hora").html(hora+":"+minutos+":"+segundos+":"+meridiano);
    },1000);
  }

  reloj();
</script>
