<?php
include_once 'app/conexion.php';
//LEER
$sql_leer = 'SELECT * FROM jugadores ORDER BY score DESC';

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();

?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- Importa librerías desde CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/addons/p5.dom.min.js"></script>
    <!-- Importa librerías desde los assets -->
    <script language="javascript" type="text/javascript" src="assets/lib/p5.serialport.js"></script>

    <link rel="stylesheet" href="assets/css/estilos.css">
    <script src="app/formulario.js"></script>
    <script src="app/reproductor.js"></script>

    <title>LeSmart</title>

</head>

<body onLoad="initPlayer()">


<style>
@import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap');
body{
    background:#9FCC2E;
    font-family: 'Comic Neue', cursive;
}
.boton-inicio:hover{
  transform: scale(1.2);
  transition: all .5s;
}
.clasificaciones1{
    height: 4rem;
    background-image: url('./assets/img/clasif.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    box-shadow: 0px 0px 3px orange;
}
.clasificaciones2{
    height: 4rem;
    background-image: url('./assets/img/salir2.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    box-shadow: 0px 0px 3px orange;
}
.clasi{
    position: absolute;
    right: 0px;
    z-index: 11;

}
.clasi div{
    margin:1rem;
    border-radius: 1rem;
}
.clasificaciones2:hover{
    transform: scale(1.3);
    transition: all .5s;
    box-shadow: 0px 0px 6px red;
}
.clasificaciones1:hover{
    transform: scale(1.3);
    transition: all .5s;
    box-shadow: 0px 0px 6px orange;
}
.clasificaciones2 a{
    height: 110%;
    width: 150%;
    display: flex;
    justify-content: center;
    align-content: center;
}
.pausar{
    background: #00B9FF;
    color: white;
}
.silenciar{
    background: darkorange;
    color: white;
}
.pausar:hover{
    z-index: 10;
    transform: scale(1.2);
    transition: all .5s;
    box-shadow: 0px 0px 5px #00B9FF;
}
.silenciar:hover{
    z-index: 10;
    transform: scale(1.2);
    transition: all .5s;
    box-shadow: 0px 0px 5px orange;
}
.jugar{
    animation-name: example;
    animation-duration: 2s;
    animation-iteration-count: infinite;
    animation-direction: alternate-reverse;
}
@keyframes example {
  from {transform: scale(1.4);color: orange;}
  to {transform: scale(1); color: darkorange;}
}
.tabla-letras{
    text-shadow: 0px 0px 3px black;
    font-size: 1.3rem;
    color: white;
}
.tabla-fondo{
    background-image: url('./assets/img/inicio.png');
    background-size: cover;
    background-repeat: no-repeat;
}
.boton-limpiar{
    border-radius: 1rem;
    background: darkorange;
    color: white;
}
.boton-cerrar{
    color: white;
    border-radius: 1rem;
    background: #D80505;
}
.boton-limpiar:hover{
    transform: scale(1.1);
    transition: all .5s;
    box-shadow: 0px 0px 5px orange;
}
.boton-cerrar:hover{
    transform: scale(1.1);
    transition: all .5s;
    box-shadow: 0px 0px 5px red;
}
.cabeza-tabla{
    font-size: 1.5rem;
    background: rgba(0,0,0,0.7);
    color: darkorange;
}
.boton-guardar{
    background: #83A726;
    color: darkorange;
    border-radius: 1rem;
    font-size: 2rem;
    text-shadow: 0px 0px 2px black;
}
.boton-guardar:hover{
    transform: scale(1.1);
    transition: all .5s;
}
.hada-hablando{
    color: orange;
    text-shadow: 0px 0px 3px black;
    font-size: 2rem;
}
.puntos{
    color: #9FCC2E;
    font-size: 2rem;
}
.titulo-modal{
    font-size: 4rem;
    color: darkorange;
    margin-top: 4rem;
}
.boton-modal{
    padding: 2rem;
    border-radius: 1rem;
    color: white;
    background:#9FCC2E;
    font-size: 3rem;
    margin-left: 10%;
    margin-top: 10rem;
}
.boton-modal:hover{
    transform: scale(1.1);
    transition: all .5s;
    box-shadow: 0px 0px 7px #9FCC2E;
}
video{
    padding-left: 10%;
}
@media (max-width: 1200px) {
  .clasi div{
    height: 2.5rem;
  }
}
</style>


























    <!-- div donde están ubicados los botones de abajo-->
    <div class="container-fluid">
            <!-- div donde están ubicados los botones de arriba-->
        <div class="row col-12">
            <div class="row col-2 clasi">

                <div class="col-3 clasificaciones1" type="button" class="btn" data-toggle="modal" data-target="#contacto" id="cargarRecords" onclick="pausarVideo()">
                </div>

                <div class="col-3 clasificaciones2" type="button" class="btn" data-toggle="modal">
                    <a href="index.php"></a>
                </div>

            </div>
        </div>
            <!--ACABAN div donde están ubicados los botones de arriba-->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background:transparent;border: 0px">
      <div class="modal-header titulo-modal justify-content-center">
        PAUSADO
      </div>

      <div class="modal-body">
        <button type="button" class="btn boton-modal" onclick="pausarVideo()" data-dismiss="modal">Seguir jugando</button>
      </div>
    </div>
  </div>
</div>





        <video muted loop id="myVideo" class="video" width="100%">
            <source src="assets/vid/love.mp4" type="video/mp4">
        </video>
        <div class="row align-items-end justify-content-end text-center text-light">
            <div class="col-md-3 botones-abajo-derecha fixed-bottom">

                <button type="button" class="btn col-3 pausar" data-toggle="modal" data-target="#exampleModal" id="btnPausar" onclick="pausarVideo()">Pausar</button>
                <button type="button" class="btn col-3 silenciar" id="btnSilenciar" onclick="silenciarVideo()">Silenciar</button>

            </div>
        </div>
        <div class="row">
            <div class="ingresa-nombre-niño d-none" id="ingresoNombreE" style="border:0px;">
                <p class="hada-hablando" style="border:0px;">Como te llamas pequeño ratoncito</p>
                <div class="alert alert-success d-none" id="mensajeExito">Estudiante guardado</div>
                <div class="alert alert-danger d-none" id="mensajeError"></div>
                <!-- Fila de ingresar valores-->
                <form id="formulario" novalidate method="POST" action="index.php">
                    <div class="row form-group justify-content-center">
                        <div class="col-md-8 mt-3">
                            <input type="text" name="nombreJugador" value="" id="nombreJugador" class="form-control" required>
                        </div>
                    </div>
                    <!-- Fila botón para guardar el nombre-->
                    <div class="row justify-content-center">
                        <button type="submit" class="btn boton-guardar mt-3">Guardar</button>
                    </div>
                </form>

            </div>
            <!-- Fila de continuar con el video después de guardar el nombre -->
            <div class="ingresa-nombre-niño text-center d-none" id="cargaNombreP">
                <h1 class="display-5 hada-hablando">El hada guardo tu nombre en su maletin</h1>
                <button type="button" class="btn boton-guardar mt-3" onclick="pausarVideo()">Continuar</button>
            </div>
            <!-- Fila donde muestra el nombre ingresado reciente -->
            <div class="nombre-en-pantalla">
                <div class="ingresa-nombre-niño display-5 lead text-center text-light font-weight-bold d-none" id="participanteP">

                </div>
            </div>
            <!-- Fila donde muestra el puntaje reciente -->
            <div class="putanje-en-pantalla">
                <p class="display-5 text-light font-weight-bold puntos" id="puntajeP">Puntos: 0</p>
            </div>
            <div class="botones-opcion-multiple" id="padreBotones">
                <button class="btn btn-info py-2 px-3 d-none" id="btnPrueba">Prueba</button>
            </div>
            <div class="d-none" id="regla-de-medicion">
                <div class="valor-barra-en-pantalla">
                    <h1 class="text-light display-4 mr-5 mb-4" id="ultrasonido"></h1>
                </div>
                <div class="col-md-2 barra-en-pantalla">
                    <!-- Fila donde muestra la barra -->

                    <div class="progress md-progress verticalrotate" style="height: 20px">
                        <div id="dynamic" class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style=" height: 50px" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!--Fin del div donde están ubicados los botones -->































    <!-- Modal  HOME-->
    <div class="modal fade bd-example-modal-xl" id="home" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" style="background:transparent; border: 0px;padding: 220px;">
                <div class="modal-body">
                    <!-- Fila botón para continuar con el video-->
                    <div class="row justify-content-center">
                        <a class="text-light mt-5 pt-4" role="button" id="enviarNombre" name="enviarNombre" style="transform: scale(2.5); padding: 3rem;">
                            <button class="boton-inicio fas fa-play-circle display-1" onclick="pausarVideo()" data-dismiss="modal" style="color: darkorange;"></button>
                        </a>

                    </div>
                        <p class="row justify-content-center jugar" style="padding: 2rem; font-size: 4rem; color: orange;text-shadow:0px 0px  5px black">JUGAR</p>
                </div>
            </div>
        </div>
    </div><!-- Modal  HOME-->

























    <!-- Modal  Records-->
    <div class="modal" id="contacto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content text-light tabla-fondo">
                <div class="modal-header">
                    <h5 class="modal-title w-100 display-4 text-center" id="exampleModalLongTitle" style="color: darkorange;text-shadow: -1px 1px 3px black">Puntajes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="pausarVideo()">
                        <span class="fa-layers fa-fw">
                            <i class="fas fa-circle" style="color:Tomato"></i>
                            <i class="fa-inverse fas fa-times" data-fa-transform="shrink-6"></i>
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <table class="table-responsive">
                                <table class="table table-hover table-borderless tabla-letras">

                                    <thead class="cabeza-tabla">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Score</th>

                                        </tr>
                                    </thead>
                                    <tbody id="actualizar">

                                    </tbody>
                                </table>
                            </table>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn boton-limpiar" id="limpiarRecords">Limpiar</button>
                    <button type="button" class="btn boton-cerrar" data-dismiss="modal" onclick="pausarVideo()">Cerrar</button>
                </div>
            </div>
        </div>
    </div><!-- Modal  Records-->



























    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="app/formulario.js"></script>
    <script src="app/reproductor.js"></script>

    <script>
        $(function() {
            $("#home").modal();
        });
    </script>

</body>

</html>