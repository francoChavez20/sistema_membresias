<?php

include ('../../config.php');

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$dni = $_GET['dni'];
$telefono = $_GET['telefono'];
$id_membresia = $_GET['id_membresia'];
$estado_membresia = $_GET['estado_membresia'];
$fecha_comienzo = $_GET['fecha_comienzo'];
$fecha_final = $_GET['fecha_final'];

$sentencia = $pdo->prepare("INSERT INTO miembros
       ( nombre, apellido, dni, telefono, id_membresia, estado_membresia, fecha_comienzo,fecha_final) 
VALUES ( :nombre, :apellido, :dni, :telefono, :id_membresia, :estado_membresia, :fecha_comienzo, :fecha_final)");

$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('apellido',$apellido);
$sentencia->bindParam('dni',$dni);
$sentencia->bindParam('telefono',$telefono);
$sentencia->bindParam('id_membresia',$id_membresia);
$sentencia->bindParam('estado_membresia',$estado_membresia);
$sentencia->bindParam('fecha_comienzo',$fecha_comienzo);
$sentencia->bindParam('fecha_final',$fecha_final);


if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro al miembro de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/miembros/miembros.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/miembros/miembros.php";
    </script>
    <?php
}