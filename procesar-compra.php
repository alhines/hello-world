<?php
session_start();
include "admin/includes/libreria.php";
$conn = connection();

if (isset($_REQUEST['nombre']) && (!empty($_REQUEST['nombre']))){
   $nombre = $_REQUEST['nombre'];
}

if (isset($_REQUEST['email']) && (!empty($_REQUEST['email']))){
   $email = $_REQUEST['email'];
}

foreach ($_SESSION["productos_seleccionados"] as $producto) {
	
	$monto_total = 0;
	
	$monto_total = $producto["precio"] * $producto["cantidad"];	
	
	$sql = "INSERT INTO compras (id_producto, cantidad_producto, nombre_cliente, correo_cliente, monto_total) values ('".$producto["id"]."','".$producto["cantidad"]."','".$nombre."','".$email."','".$monto_total."')";
	
	$result = procesar_query($sql);	
}

//Cierra lo conexion    
close_db($conn);

//Limpia la sesion
session_unset();

//Destruye la sesion
session_destroy();
?>