<?php
session_start();

echo "<pre>";
print_r($_SESSION["productos_seleccionados"]);
echo "</pre>";


foreach ($_SESSION["productos_seleccionados"] as $producto) {
	echo $producto["id"].' '.$producto["nombre"].' '.$producto["precio"].' '.$producto["cantidad"];
	echo "<br><br>";
}
?>

