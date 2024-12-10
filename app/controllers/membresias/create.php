<?php

include ('../../config.php');

$nombre = $_GET['nombre'];
$precio = $_GET['precio'];
$descripcion = $_GET['descripcion'];


$sentencia = $pdo->prepare("INSERT INTO tipo_membresia
       ( nombre, precio, descripcion) 
VALUES ( :nombre, :precio, :descripcion)");

$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('precio',$precio);
$sentencia->bindParam('descripcion',$descripcion);



if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro la membresia de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/membresias/index.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/membresias/index.php";
    </script>
    <?php
}