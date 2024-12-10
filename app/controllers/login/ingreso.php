<?php

include('../../config.php');

// Traemos los datos del formulario de login
$usuario = $_POST['usuario'];
$password = $_POST['contraseña'];

$contador = 0;
$sql = "SELECT * FROM usuario WHERE usuario = :usuario";
$query = $pdo->prepare($sql);
$query->execute(['usuario' => $usuario]);
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $contador = $contador + 1;
    $usuario_tabla = $usuario['usuario'];
    $nombre = $usuario['nombre'];
    $password_hash = $usuario['password']; // La contraseña encriptada almacenada en la base de datos
}

if ($contador == 0) {
    echo "Datos incorrectos";
    session_start();
    $_SESSION['mensaje'] = "error, datos incorrectos";
    header('Location: '.$URL.'/login/login.php');
} else {
    // Verificamos si la contraseña ingresada es correcta
    if (password_verify($password, $password_hash)) {
        echo "Datos correctos";
        session_start();
        $_SESSION['user'] = $usuario_tabla;
        header('Location: '.$URL.'/index.php');
        echo "exitoso";
    } else {
        echo "Datos incorrectos";
        session_start();
        $_SESSION['mensaje'] = "error, datos incorrectos";
        header('Location: '.$URL.'/login/login.php');
    }
}

?>
