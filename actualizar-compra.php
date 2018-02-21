<?php
session_start();
session_unset();

$productos_seleccionados = array();

if(isset($_POST['cantidad_productos']) && !empty($_POST['cantidad_productos'])){
	$cantidad_productos = $_POST['cantidad_productos'];
}

$seleccionado = false;

//Verifica cual producto fue seleccionado para guardarlo en un arreglo asociativo

for($i=0;$i<$cantidad_productos;$i++){
	
	if (array_key_exists("producto".$i,$_POST))
      {
         $productos_seleccionados[$i]["id"] = $_POST["idproducto".$i];
	     $productos_seleccionados[$i]["nombre"] = $_POST["nombre".$i];
	     $productos_seleccionados[$i]["precio"] = $_POST["precio".$i];
	     $productos_seleccionados[$i]["cantidad"] = $_POST["cantidad".$i];
		 $seleccionado = true;		
      }      
}

if (!$seleccionado){
  $error = 1;
}else{
  $error = 0;	
}

//Guarda el arreglo de productos seleccionados en una sesion. 

$_SESSION["productos_seleccionados"] = $productos_seleccionados;

header("Location: index.php?retorno=".$error);
?>


