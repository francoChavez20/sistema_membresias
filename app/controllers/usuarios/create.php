<?php
include('../../config.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$contraseña2 = $_POST['contraseña2'];
$rol = $_POST['rol'];

if ($contraseña == $contraseña2) {
    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO usuario (`nombre`, `apellido`, `usuario`,`password`,`rol`) 
VALUES (:nombre,:apellido,:usuario,:password,:rol)");

$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('apellido', $apellido);
$sentencia->bindParam('usuario', $usuario);
$sentencia->bindParam('password', $contraseña);
$sentencia->bindParam('rol', $rol);
$sentencia->execute();
session_start();
    $_SESSION['mensaje'] = "Se registró al usuario de la manera correcta";
    header('Location: ' . $URL . '/usuario/usuario.php');
}else {
    //echo "error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "error las contraseñas no son iguales";
    header('Location: ' . $URL . '/usuario/create.php');
}





?>