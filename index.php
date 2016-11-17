<?php

//code to know developing issues
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
//end code issues
  
require_once("../../resourcespwc/class/mainclass.php");
$idUsuario = $_GET['USER_ID'];
$idEvento='11';

$objGet  = new GETDATA();
$objPost = new POSTDATA();

$dataEvento=$objGet->getDatosEvento($idEvento);
if($objGet->getValidacionEncuesta($idEvento, $idUsuario)){
  $valEncuesta = 1;
} else {
  $valEncuesta = 0;
}
//$dataEvento['estatus_evento'] = 'live';
switch ($dataEvento['estatus_evento']) {
    case 'carton':
        $identifierSesion='carton';
        break;
    case 'live':
        $identifierSesion='live';
        break;
    case 'vod':
        $identifierSesion=$dataEvento['id_video_vod'];
        break;
    
    default:
        $identifierSesion='error';
        break;
}

if(empty($dataEvento)){
  include '../../resourcespwc/templates/template-alert-bd.html';
}else{
    
    $idVisita=$objPost->insertRegistro($idUsuario,$idEvento,$identifierSesion);

  if(empty($idVisita)||$idVisita==''){
    include '../../resourcespwc/templates/template-alert-bd.html';
    //echo "2";
  }else{?>
    <!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="shortcut icon" type="../../resourcespwc/images/png" href="favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">
        <link rel="stylesheet" type="text/css" href="../../resourcespwc/css/bootstrap.css">
        <link rel="stylesheet"  type="text/css" href="../../resourcespwc/css/styles.css">
        <link rel="stylesheet"  type="text/css" href="../../resourcespwc/css/bootstrap.icon-large.min.css">
        <link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        <script src="../../resourcespwc/js/jquery-2.1.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-latest.js"></script>
        <script src="../../resourcespwc/js/bootstrap.js"></script>

         <script type="text/javascript">

          $(document).ready(function() {
            /*try{
              $('#mymodalnew').modal('show');
            }catch(error){
              console.log(error);
            }*/
          });
      </script>

      <title><?php echo $dataEvento['nombre_evento']; ?></title>

    </head>
    <body>

    <p id="comodin-id-visita" value="" style="display: none;"><?= $idVisita; ?></p>
    <p id="comodin-id-evento" value="" style="display: none;"><?= $idEvento; ?></p>
    <p id="comodin-id-usuario" value="" style="display: none;"><?= $idUsuario; ?></p>
    <p id="comodin-estatus"    value="" style="display: none;"><?= $dataEvento['estatus_evento']; ?></p>
    <p id="comodin-encuesta" value="" style="display: none;"><?= $valEncuesta; ?></p>
    <p id="comodin-refresh" value="" style="display: none;">0</p>
    <div class="page-container">
    <style type="text/css">
    </style>

    <?php
      switch ($dataEvento['estatus_evento']) {
        case 'carton':
          include '../../resourcespwc/templates/template-carton.html';
          break;
        case 'live':
          include '../../resourcespwc/templates/template-live.html';
          include '../../resourcespwc/templates/template-encuesta.html';
          break;
        case 'vod':
          include '../../resourcespwc/templates/template-vod.html';
          break;
        default:
          # code...
          break;
      }
    ?>

    </div>

    <!--Analitycs START-->
    <?php echo $dataEvento['script_analytics']; ?>
    <!--Analitycs END-->
    </body>
    <script src="../../resourcespwc/js/funciones.js"></script>
    </html>
  <?php
  }  
}
?>