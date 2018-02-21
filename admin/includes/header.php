<?php
//inicio de sesion
session_start();
include('libreria.php');

if (!isset($_SESSION['acceso']['user'])) {
    header('location: login.php?err=1');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Proyecto 1</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Proyecto 1</a>
        </div>
        <div style="display: block">
            <span style="color: white">Bienvenido
                <?php
                    $bienvenida = (isset($_SESSION['acceso']['user'])) ? $_SESSION['acceso']['nombre'] : 'Invitado';
                    print $bienvenida;
                ?>
            </span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">           
            <li <?php if(contains(curPageURL(),"dashboard.php")){ ?> class="active" <?php } ?>><a href="dashboard.php">Home</a></li>
            <li <?php if(contains(curPageURL(),"productos.php")){ ?> class="active" <?php } ?>><a href="productos.php">Productos</a></li>
            <li <?php if(contains(curPageURL(),"usuarios.php")){ ?> class="active" <?php } ?>><a href="usuarios.php">Usuarios</a></li>
            <li <?php if(contains(curPageURL(),"compras.php")){ ?> class="active" <?php } ?>><a href="compras.php">Compras</a></li>
            <li><a href="includes/procesar.php?loginAccess=3&error=false">Logout</a></li>
          </ul>
          <?php /*?><form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form><?php */?>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">