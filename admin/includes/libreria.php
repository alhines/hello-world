<?php

function f_usuario($con_db,$email,$password){
    $usuario =  array();
    $sql = "SELECT * from usuarios where email = '$email' and password = '$password'";

    $resultado = consulta($con_db, $sql);

    if($resultado->num_rows > 0) {

       $row = $resultado->fetch_assoc();

       $usuario['email'] = $row['email'];
       $usuario['password'] = $row['password'];
       $usuario['nombre'] = $row['nombre'];

    }else{

       $usuario['email'] = "";
       $usuario['password'] = "";
       $usuario['nombre'] = "";
    }

    return $usuario;

}

function f_login($email, $pass) {
    $resultado = false;
    $con_db = connection();

    $usuario = f_usuario($con_db,$email,$pass);

    if(($usuario['email'] == $email) && ($usuario['password'] == $pass)) {
        $_SESSION['acceso']['user'] = $usuario['email'];
        $_SESSION['acceso']['pass'] = $usuario['password'];
        $_SESSION['acceso']['nombre'] = $usuario['nombre'];
        $resultado = true;
    }

	close_db ($con_db);

    return $resultado;
}

function f_logout() {
  //limpia la sesion
  session_unset();
  //elimina la sesion
  session_destroy();
  header('location: ../login.php');
}

function contains($full,$search){
	$found = false;
	if(strlen(strstr($full,$search))>0){
		$found = true;
	}
	return $found;
}

function curPageURL() {
	$pageURL = 'http';
	//if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function connection() {
    $link = new mysqli("localhost", "root", "", "proyecto1");

    if($link === false) {
        return $link->connect_error;
    }

    return $link;
}

function create_database() {
    //Creacion de base de datos
    $sql = "CREATE DATABASE ejemplo";

    if($link->query($sql) == TRUE) {
        return true;
    }
    else
    {
        return $link->error;
    }
}

function create_table ($table) {
    //Creacion de tabla
    $sql = "CREATE TABLE ".$table." (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        ultimo_acceso TIMESTAMP)";

    if($link->query($sql) == TRUE) {
        return true;
    }
    else
    {
        return $link->error;
    }
}


function consulta($link, $sql) {
    if($link->query($sql) == TRUE) {

        $conn = $link->query($sql);
        return $conn;
    }
    else
    {
       return $link->error;
    }
}

function procesar_query($sql) {

    $conn = connection();

    $result = $conn->query($sql);
    close_db($conn);
    return $result;

}

function renderTablaUsuarios($result) {

    $tabla = "<table class='table table-hover'>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td>Editar</td>
                            <td>Borrar</td>
                        </tr>
                    </thead>
                    <tbody>";
     while($row = $result->fetch_assoc()) {
        $tabla .= '<tr><td>' . $row['id'] . '</td><td>'. $row['nombre'] . '</td><td>'. $row['email']. '</td><td>'. $row['password'].'</td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default editar-usuario">Editar</a></td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default eliminar-usuario">Borrar</a></td></tr>';
    }
    $tabla .= "</tbody></table>";


    return $tabla;
}

function renderTablaProductos($result) {

    $tabla = "<table class='table table-hover'>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
							<td>Precio</td>
                            <td>Editar</td>
                            <td>Borrar</td>
                        </tr>
                    </thead>
                    <tbody>";
     while($row = $result->fetch_assoc()) {
        $tabla .= '<tr><td>' . $row['id'] . '</td><td>'. $row['nombre'] . '</td><td>$'. $row['precio'] . '</td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default editar-producto">Editar</a></td><td><a href="#" data-id="'.$row['id'].'" class="btn btn-default eliminar-producto">Borrar</a></td></tr>';
    }
    $tabla .= "</tbody></table>";


    return $tabla;
}


function close_db ($link) {
    $link->close();
}

//Usuarios

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 1)){


    if (isset($_REQUEST['nombre']) && (!empty($_REQUEST['nombre']))){
        $nombre = $_REQUEST['nombre'];
    }

    if (isset($_REQUEST['email']) && (!empty($_REQUEST['email']))){
        $email = $_REQUEST['email'];
    }

	if (isset($_REQUEST['password']) && (!empty($_REQUEST['password']))){
        $password = $_REQUEST['password'];
    }

    $sql = "INSERT INTO usuarios (nombre, email, password) values ('".$nombre."','".$email."','".$password."')";

    $result = procesar_query($sql);

    $sql = "Select * from usuarios";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaUsuarios($result);
    close_db($conn);
    echo $imprimir_tabla;

}

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 2)){

    if (isset($_REQUEST['id']) && (!empty($_REQUEST['id']))){
        $codigo = $_REQUEST['id'];
    }

    $sql = "Select * from usuarios where id='".$codigo."'";
    $conn = connection();
    $result = consulta($conn,$sql);

    echo json_encode($result->fetch_assoc());
}


if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 3)){


    if (isset($_REQUEST['nombre']) && (!empty($_REQUEST['nombre']))){
        $nombre = $_REQUEST['nombre'];
    }

    if (isset($_REQUEST['email']) && (!empty($_REQUEST['email']))){
        $email = $_REQUEST['email'];
    }

	if (isset($_REQUEST['password']) && (!empty($_REQUEST['password']))){
        $password = $_REQUEST['password'];
    }

    if (isset($_REQUEST['codigo']) && (!empty($_REQUEST['codigo']))){
        $codigo = $_REQUEST['codigo'];
    }

    $sql = "UPDATE usuarios SET nombre = '".$nombre."', email = '".$email."' , password = '".$password. "' where id='".$codigo."'";

    $result = procesar_query($sql);

    $sql = "Select * from usuarios";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaUsuarios($result);
    close_db($conn);
    echo $imprimir_tabla;

}

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 4)){

    if (isset($_REQUEST['id']) && (!empty($_REQUEST['id']))){
        $codigo = $_REQUEST['id'];
    }

    $sql = "DELETE from usuarios where id='".$codigo."'";

    $result = procesar_query($sql);

    $sql = "Select * from usuarios";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaUsuarios($result);
    close_db($conn);
    echo $imprimir_tabla;

}

//Productos

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 5)){


    if (isset($_REQUEST['nombre']) && (!empty($_REQUEST['nombre']))){
        $nombre = $_REQUEST['nombre'];
    }

	if (isset($_REQUEST['precio']) && (!empty($_REQUEST['precio']))){
        $precio = $_REQUEST['precio'];
    }

    $sql = "INSERT INTO productos (nombre,precio) values ('".$nombre."','".$precio."')";

    $result = procesar_query($sql);

    $sql = "Select * from productos";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaProductos($result);
    close_db($conn);
    echo $imprimir_tabla;

}

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 7)){

    if (isset($_REQUEST['id']) && (!empty($_REQUEST['id']))){
        $codigo = $_REQUEST['id'];
    }

    $sql = "Select * from productos where id='".$codigo."'";
    $conn = connection();
    $result = consulta($conn,$sql);

    echo json_encode($result->fetch_assoc());
}


if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 6)){


    if (isset($_REQUEST['nombre']) && (!empty($_REQUEST['nombre']))){
        $nombre = $_REQUEST['nombre'];
    }

	if (isset($_REQUEST['precio']) && (!empty($_REQUEST['precio']))){
        $precio = $_REQUEST['precio'];
    }

    if (isset($_REQUEST['codigo']) && (!empty($_REQUEST['codigo']))){
        $codigo = $_REQUEST['codigo'];
    }

    $sql = "UPDATE productos SET nombre = '".$nombre."' , precio = '".$precio. "' where id='".$codigo."'";

    $result = procesar_query($sql);

    $sql = "Select * from productos";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaProductos($result);
    close_db($conn);
    echo $imprimir_tabla;

}

if ((isset($_REQUEST['op'])) && ($_REQUEST['op'] == 8)){

    if (isset($_REQUEST['id']) && (!empty($_REQUEST['id']))){
        $codigo = $_REQUEST['id'];
    }

    $sql = "DELETE from productos where id='".$codigo."'";

    $result = procesar_query($sql);

    $sql = "Select * from productos";
    $conn = connection();
    $result = consulta($conn,$sql);
    $imprimir_tabla = renderTablaProductos($result);
    close_db($conn);
    echo $imprimir_tabla;
}
?>