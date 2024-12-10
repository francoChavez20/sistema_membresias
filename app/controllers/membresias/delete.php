<?php

include ('../../config.php');

$id_membresia = $_GET['id_membresia'];

$sentencia = $pdo->prepare("DELETE FROM tipo_membresia WHERE id_membresia=:id_membresia ");

$sentencia->bindParam('id_membresia',$id_membresia);

if($sentencia->execute()){
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se elimino la membresia de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/membresias/index.php";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/membresias/index.php";
    </script>
    <?php
}