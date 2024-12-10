<?php

session_start();
if (isset($_SESSION['user'])) {
  //echo "si existe sesion de: ".$_SESSION['sesion_email'];
  $usuario_session = $_SESSION['user'];
  $sql = "SELECT*FROM usuario WHERE usuario = '$usuario_session'";
  $query = $pdo->prepare($sql);
  $query->execute();
  $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
  foreach ($usuarios as $usuario) {
     $nombres_session = $usuario['nombre'];
     $apellido_session = $usuario['apellido'];
     $rol_sesion=$usuario['rol'];
     $_SESSION['rol'] = $rol_sesion; // Guarda el rol en la sesión
  }
} else {
  echo "no existe sesion";
  header('Location: ' . $URL . '/login/login.php');
  
}

?>